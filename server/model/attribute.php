<?php
include_once('baseModel.php');
class Attribute extends BaseModel {
  public $_table = "attribute";
  public $id;
  public $idConcept;
  public $name;
  public $type;
  
}
?>