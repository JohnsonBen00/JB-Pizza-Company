<?php
class DatabaseAdaptor {
  private $DB; // The instance variable used in every method
  // Connect to an existing data based named 'first'
  public function __construct() {
    $dataBase = 'mysql:dbname=first; charset=utf8; host=127.0.0.1';
    $user = 'root';
    $password = '';
    try {
      $this->DB = new PDO ( $dataBase, $user, $password );
      $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch ( PDOException $e ) {
      echo ('Error establishing Connection');
      exit ();
    }
  }
  
  // Return all customer records as a PHP associative array.
  public function getAllRecords() {
    $stmt = $this->DB->prepare ( "SELECT * FROM customers" );
    $stmt->execute ();
    return $stmt->fetchAll ( PDO::FETCH_ASSOC );
  }
} // End class DatabaseAdaptor

// Test code: Run as CLI console app, then comment this out with the server
// $theDBA = new DatabaseAdaptor ();
// // Remove the following test lines after tested
// $arr = $theDBA->getAllRecords ();
// echo $arr [0] ['ID'] . PHP_EOL;
// echo $arr [1] ['Name'] . PHP_EOL;
// print_r ( $arr );
?>