<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title'       => 'Découvrez les Meilleurs Laptops',
                'subtitle'    => 'Nouvelle Collection 2024',
                'button_text' => 'Voir les Laptops',
                'button_url'  => '/categories/laptops',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'title'       => 'Smartphones Haut de Gamme',
                'subtitle'    => 'Les Meilleures Marques',
                'button_text' => 'Voir les Smartphones',
                'button_url'  => '/categories/smartphones',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'title'       => 'Jusqu\'à -30% sur les Accessoires',
                'subtitle'    => 'Offres Limitées',
                'button_text' => 'Profiter des offres',
                'button_url'  => '/categories/accessoires',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($banners as $data) {
            Banner::firstOrCreate(['title' => $data['title']], $data);
        }
    }
}
