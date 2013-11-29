<?php
include_once('baseModel.php');
class Attribute extends BaseModel {
  public $_table = "attribute";
  public $id;
  public $tableId;
  public $name;
  public $type;
  
}
?>