<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Braian Jose',
            'email' => 'kobestreet66@gmail.com',
            'lastname' => 'Fernandez',
            'password' => bcrypt('kobestreet2013'),
            'phone' => '3794727379',
            'document' => '38317574',
            'typeofdocument' => '1',
        ]);

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(1500)->create();
    }
}
