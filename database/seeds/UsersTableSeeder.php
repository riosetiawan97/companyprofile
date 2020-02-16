<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Rio',
        //     'username' => 'rio@gmail.com',
        //     'password' => bcrypt('12345'),
        // ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
