<?php
include_once('baseModel.php');
class Schema extends BaseModel {
  public $_table = "schema";
  public $id;
  public $name;
  public $author;
  public $created_at;
  
}
?>