<?php
include_once('baseModel.php');
class Key extends BaseModel {
  public $_table = "Key";
  public $id;
  public $idConcept;
  public $name;
  public $type;
  
  public function getIdConcept() {
      return $this->idConcept;
  }

  public function setIdConcept($idConcept) {
      $this->idConcept = $idConcept;
  }

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


}
?>