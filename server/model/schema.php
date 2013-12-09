<?php
include_once('baseModel.php');
class Schema extends BaseModel {
  public $_table = "schema";
  public $id;
  public $name;
  public $author;
  public $createdAt;
  
  public function getName() {
      return $this->name;
  }

  public function setName($name) {
      $this->name = $name;
  }

  public function getAuthor() {
      return $this->author;
  }

  public function setAuthor($author) {
      $this->author = $author;
  }

  public function getCreatedAt() {
      return $this->createdAt;
  }

  public function setCreatedAt($createdAt) {
      $this->createdAt = $createdAt;
  }


}
?>