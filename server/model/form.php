<?php
include_once('baseModel.php');
class Form extends BaseModel {
  public $_table = "form";
  public $id;
  public $name;
  public $url;
  
  public function getName() {
      return $this->name;
  }

  public function setName($name) {
      $this->name = $name;
  }

  public function getUrl() {
      return $this->url;
  }

  public function setUrl($url) {
      $this->url = $url;
  }


}
?>