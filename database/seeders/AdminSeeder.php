<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'full_name' => 'Super Admin',
            'email'     => 'admin@ldiisumedang.or.id',
            'password'  => bcrypt('Admin@1234'),
        ]);

        $admin->assignRole('admin');
    }
}
