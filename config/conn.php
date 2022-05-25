<?php

$_SERVER['INDEX'] = explode("/",$_SERVER['PHP_SELF'])[1] . '/';
// Create connection
class Database{
  private $DB_HOST = "localhost";
  private $DB_USER = "solumini";
  private $DB_PASSWORD = "abobrinha";
  private $DB_NAME = "solumini2";
  private $conn;
  
  public function __construct()
  {
    // $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    $this->conn = new PDO("mysql:dbname=$this->DB_NAME;host=$this->DB_HOST;user=$this->DB_USER;password=$this->DB_PASSWORD;charset=utf8mb4");
  }

  private function setParameters($stmt, $key, $value)
  {
    $stmt->bindParam($key, $value);
  }

  private function mountQuery($stmt, $parameters)
  {
    foreach( $parameters as $key => $value ) {
      $this->setParameters($stmt, $key, $value);
    }
  }

  public function executeQuery(string $query, array $parameters = [])
  {
    $stmt = $this->conn->prepare($query);
    $this->mountQuery($stmt, $parameters);
    $stmt->execute();
    $ar = array("rows" => $stmt->rowCount() > 0 ?: 0, "data" => $stmt->fetchAll(PDO::FETCH_ASSOC), "errorInfo" => $stmt->errorInfo(), "lastId" => $this->conn->lastInsertId());

    return $ar;
  }
  
}


?>