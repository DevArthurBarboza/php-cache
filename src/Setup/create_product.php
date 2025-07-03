<?php


require_once __DIR__ . '/../../vendor/autoload.php';

use Devarthurbarboza\Caching\Connection;

$sql = "CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50),
    price DECIMAL(6,2),
    qty INTEGER
)";

$connection = new Connection();
$connection->getConnection()->exec($sql);