<?php
include_once('baseModel.php');
class Concept extends BaseModel {
  public $_table = "table";
  public $id;
  public $idSchema;
  public $name;
  
  public function getIdSchema() {
      return $this->idSchema;
  }

  public function setIdSchema($idSchema) {
      $this->idSchema = $idSchema;
  }

  public function getName() {
      return $this->name;
  }

  public function setName($name) {
      $this->name = $name;
  }


}
?>