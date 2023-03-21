<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        User::factory(10)->create();
        User::create([
            'name' => 'Dev',
            'email' => 'dev@example.org',
            'email_verified_at' => time(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    }
}
