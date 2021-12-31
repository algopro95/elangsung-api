<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getALl()
    {
        $products = Product::get();
        return $products;
    }
}
