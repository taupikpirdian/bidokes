<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // list category
        $categories = [
            'Perkara Umum',
            'Perkara Hukum',
            'Perkara Kriminal',
            'Perkara Sosial',
            'Perkara Politik',
            'Perkara Ekonomi',
            'Perkara Kesehatan',
            'Perkara Kriminal',
            'Perkara Hukum',
            'Perkara Umum',
        ];

        // create category
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}