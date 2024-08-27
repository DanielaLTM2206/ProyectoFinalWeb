<?php
// conexion.php

class DatabaseConnection {
    private $servername = "localhost";
    private $username = "admin";
    private $password = "admin";
    private $dbname = "ferreteria";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
