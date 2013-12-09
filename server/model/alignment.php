<?php
include_once('baseModel.php');
class Alignment extends BaseModel {
  public $_table = "alignment";
  public $id;
  public $idField;
  public $idConceptMaterialized;
  public $idAttribute;
  
  public function getIdField() {
      return $this->idField;
  }

  public function setIdField($idField) {
      $this->idField = $idField;
  }

  public function getIdConceptMaterialized() {
      return $this->idConceptMaterialized;
  }

  public function setIdConceptMaterialized($idConceptMaterialized) {
      $this->idConceptMaterialized = $idConceptMaterialized;
  }

  public function getIdAttribute() {
      return $this->idAttribute;
  }

  public function setIdAttribute($idAttribute) {
      $this->idAttribute = $idAttribute;
  }


  
}
?>