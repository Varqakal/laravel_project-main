<?php

namespace App\Support;

use App\Models\Product;

class Whatsapp
{
    public static function link(?Product $product = null, ?string $message = null): ?string
    {
        $phone = preg_replace('/[^0-9]/', '', (string) config('services.whatsapp'));

        if (! $phone) {
            return null;
        }

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message ?? self::defaultMessage($product));
    }

    protected static function defaultMessage(?Product $product): string
    {
        if ($product) {
            return "Bonjour, je suis intéressé(e) par ce produit :\n"
                . $product->name . ' — $' . number_format($product->price, 2) . "\n"
                . route('products.show', $product->slug);
        }

        return 'Bonjour, je souhaite passer une commande sur Electro Vitrine.';
    }
}
