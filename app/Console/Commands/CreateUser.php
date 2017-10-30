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
        $validator = Validator::make(compact([
            'email', 'name', 'password'
        ]), [
            'email' => 'email',
            'name' => 'required|min:2',
            'password' => 'min:6'
        ]);
        if ($validator->fails()) {
            dd($validator->errors());
            return $this->error('');
        }

        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}
