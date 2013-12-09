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
  public $idForm;

  public function getName() {
      return $this->name;
  }

  public function setName($name) {
      $this->name = $name;
  }

  public function getType() {
      return $this->type;
  }

  public function setType($type) {
      $this->type = $type;
  }

  public function getIdForm() {
      return $this->idForm;
  }

  public function setIdForm($idForm) {
      $this->idForm = $idForm;
  }


  
}
?>