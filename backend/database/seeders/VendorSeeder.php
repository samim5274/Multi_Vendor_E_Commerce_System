<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // =========================
        // 5 Vendors
        // =========================
        $vendors = [
            [
                'shop_name' => 'Tech World',
                'shop_slug' => Str::slug('Tech World'),
                'shop_description' => 'Best electronics and gadgets.',
                'vendor_status' => 'approved',
                'is_active' => true,
                'wallet_balance' => 500,
                'commission_rate' => 10,
                'tax_id' => 'TAX-1001',
                'business_license' => 'LIC-5001',
                'email' => 'techworld@example.com',
                'phone' => '01710000001',
                'address' => 'Dhaka, Bangladesh',
                'city' => 'Dhaka',
                'state' => 'Dhaka',
                'country' => 'Bangladesh',
                'postal_code' => '1205',
                'featured' => true,
                'rating' => 5,
                'total_products' => 25,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'shop_name' => 'Fashion Hub',
                'shop_slug' => Str::slug('Fashion Hub'),
                'shop_description' => 'Trendy clothing and accessories.',
                'vendor_status' => 'approved',
                'is_active' => true,
                'wallet_balance' => 300,
                'commission_rate' => 12,
                'tax_id' => 'TAX-1002',
                'business_license' => 'LIC-5002',
                'email' => 'fashionhub@example.com',
                'phone' => '01710000002',
                'address' => 'Chittagong, Bangladesh',
                'city' => 'Chittagong',
                'state' => 'Chittagong',
                'country' => 'Bangladesh',
                'postal_code' => '4000',
                'featured' => false,
                'rating' => 4,
                'total_products' => 30,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'shop_name' => 'Book World',
                'shop_slug' => Str::slug('Book World'),
                'shop_description' => 'All kinds of books available.',
                'vendor_status' => 'approved',
                'is_active' => true,
                'wallet_balance' => 200,
                'commission_rate' => 10,
                'tax_id' => 'TAX-1003',
                'business_license' => 'LIC-5003',
                'email' => 'bookworld@example.com',
                'phone' => '01710000003',
                'address' => 'Sylhet, Bangladesh',
                'city' => 'Sylhet',
                'state' => 'Sylhet',
                'country' => 'Bangladesh',
                'postal_code' => '3100',
                'featured' => false,
                'rating' => 4,
                'total_products' => 15,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'shop_name' => 'Home Essentials',
                'shop_slug' => Str::slug('Home Essentials'),
                'shop_description' => 'Furniture and home decor.',
                'vendor_status' => 'approved',
                'is_active' => true,
                'wallet_balance' => 400,
                'commission_rate' => 15,
                'tax_id' => 'TAX-1004',
                'business_license' => 'LIC-5004',
                'email' => 'homeessentials@example.com',
                'phone' => '01710000004',
                'address' => 'Khulna, Bangladesh',
                'city' => 'Khulna',
                'state' => 'Khulna',
                'country' => 'Bangladesh',
                'postal_code' => '9000',
                'featured' => true,
                'rating' => 5,
                'total_products' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'shop_name' => 'Gadget Store',
                'shop_slug' => Str::slug('Gadget Store'),
                'shop_description' => 'Latest gadgets and accessories.',
                'vendor_status' => 'approved',
                'is_active' => true,
                'wallet_balance' => 350,
                'commission_rate' => 10,
                'tax_id' => 'TAX-1005',
                'business_license' => 'LIC-5005',
                'email' => 'gadgetstore@example.com',
                'phone' => '01710000005',
                'address' => 'Rajshahi, Bangladesh',
                'city' => 'Rajshahi',
                'state' => 'Rajshahi',
                'country' => 'Bangladesh',
                'postal_code' => '6000',
                'featured' => false,
                'rating' => 4,
                'total_products' => 18,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('vendors')->insert($vendors);
    }
}
