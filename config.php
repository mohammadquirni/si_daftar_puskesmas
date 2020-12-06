<?php
class Config {
  private $host = "localhost";
  // private $db_name = "si_daftar_puskesmas";
  private $db_name = "urip";
  private $username = "root";
  // private $password = "";
  private $password = "root";
  public $conn;

  public function getConnection() {
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, $this->username, $this->password);
    } catch (PDOException $exception) {
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
