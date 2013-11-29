<?php
include_once('baseModel.php');

/**
 * No need to create getters and setters
 * it is available via 'baseModel'
 * The getters and setters can be overridden
 */
class Field extends BaseModel {
  public $_table = "field";
  public $id;
  public $name;
  public $type;
  
}
?>