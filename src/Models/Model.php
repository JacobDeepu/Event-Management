<?php

namespace Src\Models;

use PDO;
use PDOException;

class Model
{
    protected $dbname;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->dbname = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function open_database_connection()
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $dsn = "pgsql:host=localhost;dbname=event";
        try {
            $pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        return $pdo;
    }

    public static function close_database_connection(&$connection)
    {
        $connection = null;
    }
}
