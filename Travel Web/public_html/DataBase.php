<?php
class Database {
    private static $instance;

    private $connection;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        $host = "localhost";
        $user = "root";
        $password = "1111";
        $database = "dbproject";
        $this->connection = new mysqli($host, $user, $password, $database);
        mysqli_query($this->connection, "set session character_set_connection=utf8;");
  mysqli_query($this->connection, "set session character_set_results=utf8;");
  mysqli_query($this->connection, "set session character_set_client=utf8;");
    }

    private function __clone() {}

    public function getConnection() {
        return $this->connection;
    }

    public function query($query) {
        return mysqli_query($this->connection, $query);
    }
}
?>