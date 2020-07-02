<?php
// use composer
// require_once __DIR__ . '/../vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
// $dotenv->load();

class Database
{
    private $connection_string;
    private $user;
    private $password;
    private $connection;

    function __construct()
    {

        $DB_NAME = 'sportradar';
        $DB_HOST = 'sportradar-mysql';
        $DB_PORT = '3306';
        $this->user = 'sportradar';
        $this->password = 'sportradar';

        $this->connection_string = 'mysql:dbname=' . $DB_NAME . ';host=' . $DB_HOST . ';port=' . $DB_PORT . ';charset=utf8';
    }

    public function connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO($this->connection_string, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->connection;
    }
}
