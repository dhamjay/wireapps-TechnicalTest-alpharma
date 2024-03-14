<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $newitem = new Customer();
        $newitem->name = 'John Doe 1';
        $newitem->email = 'john1@example.com';
        $newitem->phone = '123456789';
        $newitem->address = "123 Main St";
        $newitem->type = 'consumer';
        $newitem->created_at = now();
        $newitem->updated_at = now();
        $newitem->save();

        $newitem = new Customer();
        $newitem->name = 'John Doe 2';
        $newitem->email = 'john2@example.com';
        $newitem->phone = '123456789';
        $newitem->address = "123 Main St";
        $newitem->type = 'consumer';
        $newitem->created_at = now();
        $newitem->updated_at = now();
        $newitem->save();

        $newitem = new Customer();
        $newitem->name = 'John Doe 3';
        $newitem->email = 'john3@example.com';
        $newitem->phone = '123456789';
        $newitem->address = "123 Main St";
        $newitem->type = 'distributor';
        $newitem->created_at = now();
        $newitem->updated_at = now();
        $newitem->save();
        
        $newitem = new Customer();
        $newitem->name = 'John Doe 4';
        $newitem->email = 'john4@example.com';
        $newitem->phone = '123456789';
        $newitem->address = "123 Main St";
        $newitem->type = 'consumer';
        $newitem->created_at = now();
        $newitem->updated_at = now();
        $newitem->save();        

        $newitem = new Customer();
        $newitem->name = 'John Doe 5';
        $newitem->email = 'john5@example.com';
        $newitem->phone = '123456789';
        $newitem->address = "123 Main St";
        $newitem->type = 'pharmacy';
        $newitem->created_at = now();
        $newitem->updated_at = now();
        $newitem->save();          
    }
}
