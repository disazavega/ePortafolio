<?php

require_once dirname(__FILE__) . "/LogHelper.class.php";

class DBHelper {

  private static $dbHelper;
  private $mysqli;
  private $db;
  private $logger;
  
  private function __construct() {
    $config = require __DIR__.'/../config.php';
    $this->mysqli = new mysqli($config['dbhost'], $config['username'], $config['password']) or die("Could not connect");
    $this->db = $this->mysqli->select_db ($config['db']) or die("Database does not exist or no permission");
    $this->logger = LogHelper::instance(dirname(__FILE__) . "/../logs", LogHelper::DEBUG);
  }
  
  public static function getInstance() {
      if(DBHelper::$dbHelper == null) {
	return new DBHelper();
      }
      
      return $this->dbHelper;
  }

  public function escape($string)
  {
    return $this->mysqli->real_escape_string($string);
  }

  public function selectQuery($query) {
    $result =  $this->execute_query($query);
    $response = array();
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        array_push($response, $row);
      }
    } else {
      return false;
    }
    return $response;
  }
  
  public function insertUpdateQuery($query) {
    $result = $this->execute_query($query);
    $id = $this->mysqli->insert_id;
    return $id;
  }
  
  public function deleteQuery($query) {
    return $this->execute_query($query);
  }

  private function execute_query($query)
  {
    $res = $this->log_query($query);
    $res = $this->mysqli->query($query);
    if (!$res) {
      $this->logger->logDebug("Query execution did not succeed, error: " . $this->mysqli->error);
    }
    return $res;
  }

  private function log_query($query) {
    $this->logger->logDebug("Query Executed: " . $query);
  }
}


?>