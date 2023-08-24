<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class SeedAdminRowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'IT Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'status'=>1,
            'type'=>1,
        ]);
    }
}
