<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        // =========================
        // 10 Users
        // =========================
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'phone' => '01711111111',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'vendor_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Admin User',
                'email' => 'adminuser@gmail.com',
                'phone' => '01711111112',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'vendor_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Vendor Owner 1',
                'email' => 'owner1@gmail.com',
                'phone' => '01711111113',
                'password' => Hash::make('password'),
                'role' => 'vendor_owner',
                'vendor_id' => 1, // Tech World
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Vendor Owner 2',
                'email' => 'owner2@gmail.com',
                'phone' => '01711111114',
                'password' => Hash::make('password'),
                'role' => 'vendor_owner',
                'vendor_id' => 2, // Fashion Hub
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Vendor Staff 1',
                'email' => 'staff1@gmail.com',
                'phone' => '01711111115',
                'password' => Hash::make('password'),
                'role' => 'vendor_staff',
                'vendor_id' => 1, // Tech World
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Vendor Staff 2',
                'email' => 'staff2@gmail.com',
                'phone' => '01711111116',
                'password' => Hash::make('password'),
                'role' => 'vendor_staff',
                'vendor_id' => 2, // Fashion Hub
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Customer 1',
                'email' => 'customer1@gmail.com',
                'phone' => '01711111117',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'vendor_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Customer 2',
                'email' => 'customer2@gmail.com',
                'phone' => '01711111118',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'vendor_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Customer 3',
                'email' => 'customer3@gmail.com',
                'phone' => '01711111119',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'vendor_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Customer 4',
                'email' => 'customer4@gmail.com',
                'phone' => '01711111120',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'vendor_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
