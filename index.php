<?php 


require_once 'vendor/autoload.php';

use Devarthurbarboza\Caching\Data\Product;

function floatAleatorio($min, $max) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}

for ($i = 0; $i <= 200; $i++) {
    
    $product = new Product();
    $product->name = 'Nome Produto ' . $i + rand(1,1000);
    $product->qty = rand(0,10);
    $product->price = floatAleatorio(2, 50);
    $product->save();
}