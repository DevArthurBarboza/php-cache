<?php 

require_once 'vendor/autoload.php';

use Devarthurbarboza\Caching\Data\Product;
    
$product = new Product();


$start = microtime(true);
$product->getById(150);
$end = microtime(true);

$executionTime = $end - $start;

echo "Execution time: " . $executionTime . " seconds";

echo "\n";


$start = microtime(true);
$product->get('price', 13.35);
$end = microtime(true);

$executionTime = $end - $start;

echo "Execution time: " . $executionTime . " seconds";



echo "\n";


$start = microtime(true);
$product->get('price', 16.11);
$end = microtime(true);

$executionTime = $end - $start;

echo "Execution time: " . $executionTime . " seconds";

