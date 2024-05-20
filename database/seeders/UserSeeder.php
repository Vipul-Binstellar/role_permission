<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $SuperAdmin= User::create([
            'name'=> 'super',
            'email'=> 'super@gmail.com',
            'email_verified_at'=> now(),
            'password'=> '$2y$10$EiaOdgpr1f.DZUCWQIKnueLiC8gUQZso2DfXx3/hWReEgKVg7In7.' //12345678
        ]);
        $admin= User::create([
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'email_verified_at'=> now(),
            'password'=> '$2y$10$EiaOdgpr1f.DZUCWQIKnueLiC8gUQZso2DfXx3/hWReEgKVg7In7.' //12345678
        ]);
        $SuperAdmin->assignRole('SuperAdmin','admin');
    }
}
