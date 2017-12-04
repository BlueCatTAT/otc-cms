<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 3:41 PM
 */

namespace OtcCms\Services\Repositories\Commission;


use Doctrine\Common\Collections\Collection;
use OtcCms\Models\CommissionDaily;
use OtcCms\Models\CryptoCurrencyType;
use OtcCms\Services\OtcServer\OrderServiceInterface;
use OtcCms\Services\Repositories\Order\OrderRepositoryInterface;
use function Psy\sh;

class CommissionRepository implements CommissionRepositoryInterface
{

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var OrderServiceInterface
     */
    private $orderService;

    public function __construct(OrderRepositoryInterface $orderRepository,
                                OrderServiceInterface $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    /**
     * @param CryptoCurrencyType $type
     * @param int $page
     * @param int $limit
     * @return Collection
     */
    public function paginate(CryptoCurrencyType $type, $page = 1, $limit = null)
    {
        if (empty($limit)) {
            $limit = config('view.paginator.limit');
        }
        $query = new CommissionDaily();
        return $query->select(['total', 'ratio', 'commission', 'date'])
            ->where('crypto_type', $type->getValue())
            ->limit($limit)
            ->offset(($page-1)*$limit)
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * @param CryptoCurrencyType $type
     * @return int
     */
    public function count(CryptoCurrencyType $type)
    {
        $query = new CommissionDaily();
        return $query
            ->where('crypto_type', $type->getValue())
            ->count();
    }

    /**
     * At this moment, order table only support bitcoin, so the $type
     * parameter is redundant. But I decide to keep it just in case.
     *
     * @param string $date YYYY-MM-DD
     * @param CryptoCurrencyType $type
     * @return CommissionDaily
     */
    public function calculate($date, CryptoCurrencyType $type)
    {
        $commissionDaily = $this->findByDateAndType($date, $type);
        if ($commissionDaily) {
            return $commissionDaily;
        }
        $orderAgg = $this->orderRepository->sumQuantityAndFeeOfFinished($date, $type);
        $commissionDaily = new CommissionDaily();
        $commissionDaily->date = $date;
        $commissionDaily->crypto_type = $type->getValue();
        $commissionDaily->commission = $orderAgg['fee'];
        $commissionDaily->total = $orderAgg['quantity'];
        $commissionDaily->ratio = $orderAgg['ratio'];
        return $commissionDaily;
    }

    private function findByDateAndType($date, CryptoCurrencyType $type)
    {
        return CommissionDaily::where('date', $date)
            ->where('crypto_type', $type->getValue())
            ->first();
    }

    /**
     * @return float
     */
    public function getCurrentCommissionRatio()
    {
        $response = $this->orderService->getCurrentCommissionRatio()->getResponse();
        if (!$response->isSuccessful()) {
            return 0;
        }
        return (float) $response->getData();
    }
}