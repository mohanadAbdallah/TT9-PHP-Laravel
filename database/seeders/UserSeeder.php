<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //SQL: insert into users (name, email, password) values ( ?, ?, ? );

        //Query Builder - we use the object-oriented

        DB::table('users')->insert([
            'name' => 'Mohanad Abu El-atta',
            'email' =>'mohand@gmail.com',
            'password' => Hash::make('password'),
            // SHA (Secure Hash Algorithm),
            // MD5 (Message Digest Algorithm 5),
            // RSA (Rivest-Shamir-Adleman),
        ]);
    }
}
