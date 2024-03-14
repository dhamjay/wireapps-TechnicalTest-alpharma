<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $newuser = new User();
        // $newuser->username = 'user2';
        // $newuser->name = 'B';
        // $newuser->email = 'user2@example.com';
        // $newuser->email_verified_at = now();
        // $newuser->password = bcrypt('123456');
        // $newuser->save();
        // $newuser->assignRole('cashier');

        // // user3 role->owner id-> 2
        // $u1 = User::find(2);
        // $u1->assignRole('owner');

        // // user1 role->manager id-> 3
        // $u2 = User::find(3);
        // $u2->assignRole('manager');   
        
        // // user1 role->manager id-> 3
        // $u2 = User::find(5);
        // $u2->assignRole('cashier');         
    }
}
