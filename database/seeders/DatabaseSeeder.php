<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Family;
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
            'name' => 'Braian Jose Fernandez',
            'email' => 'kobestreet66@gmail.com',
            'password' => bcrypt('kobestreet2013'),
        ]);

        $this->call([FamilySeeder::class]);

        Product::factory(150)->create();
    }
}
