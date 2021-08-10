<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
            ],
        ];
        foreach ($admins as $adminData) {
            $admin = User::firstOrNew($adminData);
            if (!$admin->exists) {
                $admin->email_verified_at = now();
                $admin->password = bcrypt('secret');
                $admin->save();
            }
        }
    }
}
