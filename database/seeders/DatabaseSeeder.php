<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'email' => 'action8@email.com',
            'username' => 'action8',
            'first_name' => 'Rick',
            'last_name' => 'Grimes',
            'password' => Hash::make('grimes123')
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'email' => 'cocoa5@email.com',
            'username' => 'cocoa5',
            'first_name' => 'Carol',
            'last_name' => 'Peletier',
            'password' => Hash::make('carol123')
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'email' => 'unmanaged7@email.com',
            'username' => 'unmanaged7',
            'first_name' => 'Hershel',
            'last_name' => 'Greene',
            'password' => Hash::make('hershel123')
        ]);
    }
}
