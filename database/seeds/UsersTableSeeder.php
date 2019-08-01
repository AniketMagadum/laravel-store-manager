<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>env('ADMIN_USERNAME'),
            "email"=>env('ADMIN_EMAIL'),
            "password"=>bcrypt(env('ADMIN_PASSWORD')),
        ]);
    }
}
