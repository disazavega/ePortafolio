<?php
include_once('baseModel.php');
class ConceptMaterialized extends BaseModel {
  public $_table = "conceptMaterialized";
  public $id;
  public $idForm;
  public $idConcept;
  public $name;
  
  public function getIdForm() {
      return $this->idForm;
  }

  public function setIdForm($idForm) {
      $this->idForm = $idForm;
  }

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


}
?>
