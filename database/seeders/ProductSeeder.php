<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $laptops     = Category::where('name', 'Laptops')->first();
        $smartphones = Category::where('name', 'Smartphones')->first();
        $cameras     = Category::where('name', 'Caméras')->first();
        $accessories = Category::where('name', 'Accessoires')->first();

        $products = [
            // Laptops
            ['category_id' => $laptops->id,     'name' => 'Dell XPS 15 OLED',           'price' => 1499.99, 'old_price' => 1799.99, 'badge' => 'sale',  'is_featured' => true,  'description' => 'Laptop professionnel avec écran OLED 15.6", processeur Intel Core i7, 16 Go RAM, SSD 512 Go.'],
            ['category_id' => $laptops->id,     'name' => 'MacBook Pro M3 14"',          'price' => 1999.00, 'old_price' => null,     'badge' => 'new',   'is_featured' => true,  'description' => 'Le laptop Apple le plus puissant avec puce M3, écran Liquid Retina XDR, autonomie 22h.'],
            ['category_id' => $laptops->id,     'name' => 'Lenovo ThinkPad X1 Carbon',  'price' => 1299.00, 'old_price' => 1499.00,  'badge' => 'sale',  'is_featured' => false, 'description' => 'Laptop business ultra-léger (1.12 kg), Core i7 12th Gen, écran 14" IPS anti-reflet.'],
            ['category_id' => $laptops->id,     'name' => 'ASUS ROG Strix G16',         'price' => 1149.00, 'old_price' => null,     'badge' => 'hot',   'is_featured' => false, 'description' => 'Laptop gaming avec RTX 4070, Ryzen 9 7945HX, 32 Go RAM, écran 165Hz.'],

            // Smartphones
            ['category_id' => $smartphones->id, 'name' => 'iPhone 15 Pro Max',          'price' => 1199.00, 'old_price' => null,     'badge' => 'new',   'is_featured' => true,  'description' => 'iPhone 15 Pro Max 256 Go, puce A17 Pro, appareil photo 48MP, Dynamic Island.'],
            ['category_id' => $smartphones->id, 'name' => 'Samsung Galaxy S24 Ultra',   'price' => 1099.99, 'old_price' => 1299.99,  'badge' => 'sale',  'is_featured' => true,  'description' => 'Samsung phare 2024, stylet intégré, caméra 200MP, Snapdragon 8 Gen 3.'],
            ['category_id' => $smartphones->id, 'name' => 'Xiaomi 14 Pro',              'price' => 799.00,  'old_price' => 899.00,   'badge' => 'hot',   'is_featured' => false, 'description' => 'Smartphone haut de gamme Xiaomi avec Snapdragon 8 Gen 3 et caméra Leica.'],
            ['category_id' => $smartphones->id, 'name' => 'Google Pixel 8 Pro',         'price' => 899.00,  'old_price' => null,     'badge' => 'new',   'is_featured' => false, 'description' => 'Meilleur smartphone Android avec IA, Google Tensor G3, caméra 50MP.'],

            // Caméras
            ['category_id' => $cameras->id,     'name' => 'Sony Alpha A7 IV',           'price' => 2499.00, 'old_price' => 2799.00,  'badge' => 'sale',  'is_featured' => true,  'description' => 'Appareil photo hybride full-frame 33 MP, vidéo 4K 60fps, autofocus IA avancé.'],
            ['category_id' => $cameras->id,     'name' => 'Canon EOS R50',              'price' => 699.00,  'old_price' => null,     'badge' => 'new',   'is_featured' => false, 'description' => 'Appareil photo hybride APS-C 24.2 MP, idéal pour les débutants et créateurs.'],
            ['category_id' => $cameras->id,     'name' => 'GoPro HERO12 Black',         'price' => 399.00,  'old_price' => 449.99,   'badge' => 'hot',   'is_featured' => false, 'description' => 'Caméra d\'action 5.3K, stabilisation HyperSmooth 6.0, waterproof 10m.'],

            // Accessoires
            ['category_id' => $accessories->id, 'name' => 'AirPods Pro 2ème génération','price' => 249.00,  'old_price' => 299.00,   'badge' => 'sale',  'is_featured' => true,  'description' => 'Écouteurs sans fil Apple avec annulation active du bruit, son Spatial Audio.'],
            ['category_id' => $accessories->id, 'name' => 'Samsung Galaxy Buds3 Pro',   'price' => 199.00,  'old_price' => null,     'badge' => 'new',   'is_featured' => false, 'description' => 'Écouteurs Samsung avec ANC, 24h autonomie, son Hi-Fi 360.'],
            ['category_id' => $accessories->id, 'name' => 'Anker MagGo Hub 8-en-1',    'price' => 79.99,   'old_price' => 99.99,    'badge' => 'hot',   'is_featured' => false, 'description' => 'Hub USB-C 8 ports, HDMI 4K, charge 100W, compatible MacBook et PC.'],
        ];

        foreach ($products as $data) {
            $data['is_active'] = true;
            Product::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
