<?php 

namespace Devarthurbarboza\Caching;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Pdo;

class Connection {
    static $instance;

    public function getConnection()
    {
        if (self::$instance == null) {

            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            $host = $_ENV['HOST'];
            $db = $_ENV['DATABASE_NAME'];
            $user = $_ENV['USER'];
            $password = $_ENV['PASSWORD'];
            self::$instance = new PDO("pgsql:host=" . $host . ";dbname=" . $db, $user, $password);
        }
        return self::$instance;
    }
}