<?php

namespace OtcCms\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Logging\Log;
use OtcCms\Models\CommissionDaily;
use OtcCms\Models\CryptoCurrencyType;
use OtcCms\Services\Repositories\Commission\CommissionRepositoryInterface;
use OtcCms\Services\Repositories\Order\OrderRepositoryInterface;

class CommissionDailyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commission:daily {--date=} {--type='.CryptoCurrencyType::BITCOIN.'} {--real}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to calculate the total commission of yesterday(or a given day)';

    /**
     * @var OrderRepositoryInterface
     */
    private $commissionRepository;
    /**
     * @var Log
     */
    private $log;

    /**
     * Create a new command instance.
     *
     * @param CommissionRepositoryInterface $commissionRepository
     * @param Log $log
     */
    public function __construct(CommissionRepositoryInterface $commissionRepository, Log $log)
    {
        parent::__construct();
        $this->commissionRepository = $commissionRepository;
        $this->log = $log;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = $this->option('date');
        $typeValue = (int) $this->option('type');
        $real = $this->option('real');
        if (!CryptoCurrencyType::isValid($typeValue)) {
            $this->error("Cryptocurrency type $typeValue is not supported");
            return;
        }
        $type = new CryptoCurrencyType($typeValue);
        if (empty($date)) {
            $date = date('Y-m-d', strtotime('-1 day'));
        }

        try {
            $commissionDaily = $this->commissionRepository->calculate($date, $type);
            $this->info("The commission of ".$type->getKey()." on $date is:");
            $this->info("\tCommission: ".$commissionDaily->commission);
            $this->info("\tRatio: ".$commissionDaily->ratio);
            $this->info("\tTotal: ".$commissionDaily->total);
            if ($real) {
                $commissionDaily->save();
            }
        } catch (\Exception $e) {
            $this->error("Create daily commission failed, check log for more details.");
            $this->error($e->getMessage());
            $this->log->error($e->getMessage(), [
                'runtime' => 'command',
                'commandName' => 'CommissionDailyCommand',
                'params' => [
                    'date' => $date,
                    'type' => $type->getValue(),
                ]
            ]);
        }
    }
}
