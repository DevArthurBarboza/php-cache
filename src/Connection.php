<?php 

namespace Devarthurbarboza;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Pdo;

class Connection {

    private static $instance;
    private $dotenv;

    public function __construct()
    {
        $this->dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $this->dotenv->load();
        return $this->getInstance();
    }

    public function getInstance()
    {
        if (self::$instance == null) {
            $host = $_ENV['HOST'];
            $db = $_ENV['DATABASE_NAME'];
            $user = $_ENV['USER'];
            $password = $_ENV['PASSWORD'];
            self::$instance = new PDO("pgsql:host=" . $host . ";dbname=" . $db, $user, $password);
        }
        return self::$instance;
    }
}

$conn = new Connection();
$instance = $conn->getInstance();