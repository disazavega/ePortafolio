<?php
class BaseModel {
  public $id;
  public $_table;  
  
  function __call($method, $args) {
    
    /*
     * This code block provides
     * default getters and setters for all functions
     * any getter / setter function can be
     * safely overridden
     */
    $error = false;
    $properties = array_keys(get_class_vars(get_class($this)));
    $property = lcfirst(substr($method,3));
    if(substr($method,0,3) === "get") {
      if(in_array($property, $properties) && sizeof($args) == 0) {
	return $this->$property;
      } else {
	$error = true;
      } 
    } else if (substr($method,0,3) === "set") {
      if(in_array($property, $properties) && sizeof($args) == 1) {
	$this->$property = $args[0];
      } else {
	$error = true;
      } 
    } else {
      $error = true;
    }
    if($error) {
      throw new Exception("Method not found. {$method}() with ".sizeof($args)." arguments does not exist!");
    }
  }
  
}