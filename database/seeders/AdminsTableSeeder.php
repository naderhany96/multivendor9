<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminsRecords = [
            [ 
                'id' => 1,
                'name' => 'Super User',
                'type' => 'superuser',
                'vendor_id' => 0,
                'mobile' => '+9656546654',
                'email' => 'superadmin@multiv.com',
                'password' => bcrypt('11111111'),
                'image' => '',
                'status' => 1
            ]
        ];

        Admin::insert($adminsRecords);
    }
}
