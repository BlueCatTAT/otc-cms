<?php

namespace OtcCms\Console\Commands;

use Illuminate\Console\Command;
use OtcCms\Models\Role;
use OtcCms\Models\User;

class AttachRole extends Command
{
    protected $signature = 'auth:attach-role {userId} {role}';

    protected $description = 'Attach a role to a user id';

    public function handle()
    {
        $userId = $this->argument('userId');
        $role = $this->argument('role');
        $user = User::find($userId);
        $role = Role::where('name', $role)->first();
        if (empty($user)) {
            $this->error("User $userId not found");
            exit(1);
        }
        if (empty($role)) {
            $this->error("Role $role not found");
            exit(2);
        }
        $user->attachRole($role);
    }
}
