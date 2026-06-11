<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptops',      'description' => 'Ordinateurs portables performants pour le travail et le jeu.', 'sort_order' => 1],
            ['name' => 'Smartphones',  'description' => 'Les meilleurs téléphones intelligents des grandes marques.',     'sort_order' => 2],
            ['name' => 'Caméras',      'description' => 'Appareils photo et caméras pour capturer vos moments.',         'sort_order' => 3],
            ['name' => 'Accessoires',  'description' => 'Écouteurs, câbles, coques et tous les accessoires tech.',       'sort_order' => 4],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
