<?php
include_once('baseModel.php');
class FieldInstance extends BaseModel {
  public $_table = "field_instance";
  public $id;
  public $fieldId;
  public $value;
  public $date;
  
}
?>