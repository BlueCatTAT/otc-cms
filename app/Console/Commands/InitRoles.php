<?php

namespace OtcCms\Console\Commands;

use Illuminate\Console\Command;
use OtcCms\Models\Role;

class InitRoles extends Command
{
    protected $signature = 'auth:init-roles';

    protected $description = 'Initialize the roles table';

    public function handle()
    {
        if (!Role::where('name', 'viewer')->first()) {
            $viewer = new Role();
            $viewer->name = 'viewer';
            $viewer->display_name = 'View-only user';
            $viewer->description = '只看查看数据，没有修改权限';
            $viewer->save();
        }

        if (!Role::where('name', 'manager')->first()) {
            $manager = new Role();
            $manager->name = 'manager';
            $manager->display_name = 'Manager';
            $manager->description = '可以修改数据';
            $manager->save();
        }

        if (!Role::where('name', 'admin')->first()) {
            $admin = new Role();
            $admin->name = 'admin';
            $admin->display_name = 'Administrator';
            $admin->description = '管理员，可以修改用户权限';
            $admin->save();
        }
    }
}
