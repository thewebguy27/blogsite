<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $user=User::where('email','hamzaawan2277@gmail.com')->first();
    if(!$user){
        User::create([
            'name'=>'Hamza',
            'email'=>'hamzaawan2277@gmail.com',
            'password' => Hash::make('password'),
            'role'=>'admin'
        ]);
    }
    }
}
