<?php 

namespace Devarthurbarboza\Caching\Data;

use Devarthurbarboza\Connection;

class Product {

    private $database_connection;

    public function __construct()
    {
        $this->database_connection = new Connection();
    }
}