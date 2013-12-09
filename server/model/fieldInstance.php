<?php
include_once('baseModel.php');
class FieldInstance extends BaseModel {
  public $_table = "fieldInstance";
  public $id;
  public $idField;
  public $value;
  public $date;
  
  public function getIdField() {
      return $this->idField;
  }

  public function setIdField($idField) {
      $this->idField = $idField;
  }

  public function getValue() {
      return $this->value;
  }

  public function setValue($value) {
      $this->value = $value;
  }

  public function getDate() {
      return $this->date;
  }

  public function setDate($date) {
      $this->date = $date;
  }


}
?>