<?php

namespace OtcCms\Console\Commands;

use OtcCms\User;
use Illuminate\Console\Command;
use Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {email} {name} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->argument('password');
        $data = compact(['email', 'name', 'password']);
        $user = new User();
        if (!$user->validate($data)) {
            foreach ($user->errors() as $message) {
                $this->error($message);
            }
            return;
        }

        try {
            $user->fill($data);
            $user->save();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
