<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Biser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Biser::factory(10)->create();

//        $tagsCount = BiserTags::all()->count();
//
//        Biser::factory(10)->create([
//            'image' => fake()->image(),
//            'title' => fake()->title,
//            'description' => fake()->realText,
//            'price' => fake()->numberBetween(100, 1200),
//            'biser_tag_id' => fake()->numberBetween(1, $tagsCount),
//        ]);
    }
}
