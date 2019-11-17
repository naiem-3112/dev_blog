<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
           'status' => '1',
           'name' => 'Md. Naiem',
           'email' => 'naiem@naiem.com',
           'password' => bcrypt('000'),

        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'status' => '0',
            'name' => 'Md. Joy',
            'email' => 'joy@joy.com',
            'password' => bcrypt('000'),

        ]);
    }
}
