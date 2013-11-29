<?php
include_once(__DIR__ . '/../helper/DBHelper.php');
class ModelMapper {
  
  private $modelClass;
  private $_table;
  private $dbHelper;
  
  function __construct($modelClass) {
    $this->modelClass = $modelClass;
    $this->_table = (new $this->modelClass)->_table;
    $this->dbHelper = DBHelper::getInstance();
  }
  
  function load($id) {
    $model = new $this->modelClass;
    
    $query = "SELECT * FROM `{$model->_table}` WHERE `id` = " . $id;
    $results = $this->dbHelper->selectQuery($query);
    if(!$results) {
      return false;
    }
    // we assume / know there will be only one result
    $this->populateModel($model, $results[0]);
    return $model;
  }
  
  /**
   * @return - Array
   */
  function loadAll() {
    $modelArr = array();
    $query = "SELECT * FROM `{$this->_table}`";
    $results = $this->dbHelper->selectQuery($query);
    if(!$results) {
      return false;
    }
    
    foreach($results as $result) {
      $model = new $this->modelClass;
      $this->populateModel($model, $result);
      array_push($modelArr, $model);
    }
    return $modelArr;    
  }
  
  /**
   * @return - Array
   */
  function loadBy($field, $value) {
    if(!is_numeric($value)) {
      $value="\"{$value}\"";
    }
    $modelArr = array();
    $query = "SELECT * FROM `{$this->_table}` WHERE `{$field}` = ". $value;
    $results = $this->dbHelper->selectQuery($query);
    
    if(!$results) {
      return false;
    }
    
    foreach($results as $result) {
      $model = new $this->modelClass;
      $this->populateModel($model, $result);
      array_push($modelArr, $model);
    }
    return $modelArr;
  }
  
  /**
   * @return - id of updated / inserted row
   */
  function save(&$model) {
    /**
     * check if id is set, 
     * if id is set update
     * else insert
    */
    $properties = array_keys(get_class_vars(get_class($model)));
    if(isset($model->id)) {
      $innerQuery = "";
      foreach($properties as $property) {
	if(isset($property) && $property !== "_table") {
	  $innerQuery .= " `{$property}` = \"".$model->$property."\",";
	}
      }
      $innerQuery = substr($innerQuery,0,strlen($innerQuery)-1);
      
      $whereQuery = " WHERE `id` = {$model->id}";
      /*UPDATE `champ` SET `name` = "Shh" where `id` = 1*/
      $query = "UPDATE `{$model->_table}` SET " . $innerQuery . $whereQuery;
      $this->dbHelper->insertUpdateQuery($query);
      return $model->id;
      
    } else {
      $fieldsQueryArr = array();
      $valuesQueryArr = array();
      foreach($properties as $property) {
	if(isset($property) && isset($model->$property) && $property != "_table") {
	  array_push($fieldsQueryArr, "`".$property."`");
	  if(is_numeric($model->$property)) {
	    array_push($valuesQueryArr, $model->$property);
	  } else {
	    array_push($valuesQueryArr, "\"".$model->$property."\"");
	  }
	}
      }
      $fieldsQuery = implode($fieldsQueryArr,",");
      $valuesQuery = implode($valuesQueryArr,",");
      $query = "INSERT INTO `{$model->_table}` ({$fieldsQuery}) VALUES({$valuesQuery})";
      $insertId = $this->dbHelper->insertUpdateQuery($query);
      $model->id = $insertId;
      return $insertId;
    }
  }
  
  /**
   * deletes row if exits
   * unsets the object
   */
  function delete(&$model) {
    $id = $model->id;
    $query = "DELETE FROM `{$model->_table}` WHERE `id` = " . $id;
    $this->dbHelper->deleteQuery($query);
    $model = NULL;
  }
  
  private function populateModel(&$model, $dbRow) {
    foreach(array_keys($dbRow) as $property) {
      if(property_exists($model, $property)) {
	$model->$property = $dbRow[$property];
      }
    }
  }
  
}

?>