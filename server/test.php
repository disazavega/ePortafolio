<?php

include_once(__DIR__ . '/model/modelMapper.php');
include_once(__DIR__ . '/model/field.php');
include_once(__DIR__ . '/model/form.php');

class Test {
    
  var $fieldMapper; 
  
  function __construct() {
      $this->fieldMapper = new ModelMapper(get_class(new Field())); 
  }
  /**
   * inserting a singe row
   * 
   */
  function insertFields() {
  
    $form = new Form();
    $form->setName('form1');
    $form->setUrl('/form/1');
    $formMapper = new ModelMapper(get_class(new Form()));
    $formId = $formMapper->save($form);
    /** 
     * id of newly inserted form is returned 
     * after it has been successfully saved in the database
     * we can resuse that information to continue saving 
     * other data in related tables
     * 
     * In this case Form and field are mapped with formId as foreign key
     */
    
    $field = new Field();
    $field->setName('myField1');
    $field->setType('fieldType1');
    $field->setIdForm($formId);
    $this->fieldMapper->save($field);
  }
  
  /**
   * updating a row
   */
  function updateFields() {
    $field=$this->fieldMapper->load(1);
    $field->setName("myUpdateField");
    $this->fieldMapper->save($field);
  }

  /**
  * Retrieval of list of single field from a table
  */  
  function retrieveAllFields() {
    $fields = $this->fieldMapper->loadAll();
    foreach ($fields as $field) {
      print $field->getName();
      print "<br/>";
    }
  }
  
  
  /**
   * The loadBy function returns values in array even if only one row is returned
   * 
   */
  function retrieveByFilter() {
    $fields = $this->fieldMapper->loadBy('idForm', 1);
    foreach ($fields as $field) {
      print $field->getName();
    }
  }
  
  /**
   * Deleting row
   */
  function deleteField() {
    $formMapper = new ModelMapper(get_class(new Form()));
    $form = $formMapper->load(1);
    print "Before deleting : ".$form->getName();
    $formMapper->delete($form);
    /*The delete function unsets the value of $form too*/
    print "After deleting : ".$form->getName(); // should throw error
  }
  
}


$t = new Test();
$t->insertFields();
$t->updateFields();
$t->retrieveAllFields();
$t->retrieveByFilter();
$t->deleteField();


?>


