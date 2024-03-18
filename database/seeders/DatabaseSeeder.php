<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        $role = Role::where('name', 'admin')->first(); 
        $user->roles()->attach($role);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        $role = Role::where('name', 'user')->first(); 
        $user->roles()->attach($role);

        Category::create(['name' => 'Mobiles']);
        Category::create(['name' => 'Laptops']);

        Product::create([
            'name' => 'Redmi 12',
            'price' => '10000',
            'stock' => 10,
            'selling_count' => 1000,
            'category_id' => 1,
        ]);
        
        Product::create([
            'name' => 'Oppo A17',
            'price' => 9999,
            'stock' => 222,
            'selling_count' => 12,
            'category_id' => 1,
        ]);
    }
}
