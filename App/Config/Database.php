<?php
namespace App\Config;

use Dotenv\Dotenv;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct($host, $user, $password, $dbname, $port)
    {
        $dsn = 'pgsql:host=' . $host .';port='.$port. ';dbname=' . $dbname;
        $options = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->pdo = new \PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = self::createInstanceFromEnv();
        }
        return self::$instance;
    }

    private static function createInstanceFromEnv()
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];
        $port = $_ENV['DB_PORT']??'5432';

        return new self($host, $user, $password, $dbname,$port);
    }


    public function getPdo()
    {
        return $this->pdo;
    }
}



