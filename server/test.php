<?php

include_once(__DIR__ . '/model/modelMapper.php');
include_once(__DIR__ . '/model/field.php');

class Test{
  function testFields() {
    $fieldMapper = new ModelMapper(get_class(new Field()));
    $fields = $fieldMapper->loadAll();
    foreach ($fields as $field) {
      print $field->getName();
      print "<br/>";
    }
  }
}

$t = new Test();
$t->testFields();


?>


