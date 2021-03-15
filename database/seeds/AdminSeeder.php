<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('admin')) {
            DB::table('admin')->truncate();
            $data = [
                [
                    'name' => 'Super Admin',
                    'email' => 'superadmin@vastore.com',
                    'avatar' => 'https://scontent.fhan2-6.fna.fbcdn.net/v/t1.0-9/152333555_2838389663082508_2553091010362175135_n.jpg?_nc_cat=103&ccb=1-3&_nc_sid=174925&_nc_ohc=U5HwnZTCvuAAX_P9fte&_nc_ht=scontent.fhan2-6.fna&oh=e2aa97d77a9534659d099dc755436d3b&oe=6073566C',
                    'status' => 1,
                    'type' => 1,
                    'phone' => '',
                    'password' => Hash::make('123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Super Admin',
                    'email' => 'superadmin2@vastore.com',
                    'avatar' => 'https://scontent.fhan2-6.fna.fbcdn.net/v/t1.0-9/152333555_2838389663082508_2553091010362175135_n.jpg?_nc_cat=103&ccb=1-3&_nc_sid=174925&_nc_ohc=U5HwnZTCvuAAX_P9fte&_nc_ht=scontent.fhan2-6.fna&oh=e2aa97d77a9534659d099dc755436d3b&oe=6073566C',
                    'status' => 1,
                    'type' => 1,
                    'phone' => '',
                    'password' => Hash::make('123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ];
            DB::table('admin')->insert($data);
        }
    }
}
