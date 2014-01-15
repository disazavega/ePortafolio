<?php

include('smarty/Smarty.class.php');
include('services.php');
include('common_functions.php');

//GUI for the concept
if ($_POST['action'] === "new") {
  //Call services
  $service = new Services();
  $concepts = $service->ListConcepts();
  
  //Create Object
  $smarty = new Smarty;
  
  $list = array();
  
  //Assigning Values
  foreach ($concepts as $concept) {
    $list[] = array(
	    'id' => $concept->id,
	    'name' => $concept->name
	  );
  }
  
  $smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
  $smarty->assign('concepts_list', $list);
  $smarty->assign('schema_id', $_POST['schema_id']);
  $smarty->display('tpl/concept-new.tpl');
} 

//GUI for concept update
else if ($_POST['action'] === 'edit' && is_numeric($_POST['concept_id'])) {
  
  $service = new Services();
  
  
  //Create Object
  $smarty = new Smarty;
  
  $id = intval($_POST['concept_id']);
  
  $concept = $service->ListConceptById($id);
  
  $attributes = $service->ListAttributeConcept($id);
  for($i=0;$i<sizeof($attributes);$i++) {
    $attributes[$i] = (array)$attributes[$i];
  }
  $smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
  $smarty->assign('concept', array(
	  'id' => $concept->id,
	  'name' => sanitize($concept->name)
  ));
  $smarty->assign('attributes', $attributes);
  $smarty->display('tpl/concept-edit.tpl');
  
}

else if ($_POST['action'] === 'create') { // "create" is the submit action of "new"
	$service = new Services();
	
	$concept_name = $_POST['concept_name'];
	
	//storing concept	
	$res = $service->CreateConcept($_POST['schema_id'], $_POST['concept_name']);
	if (!$res) {
	  echo 'Error creating Concept !';
	} else {
	  
	  for ($i=0; $i<sizeof($_POST['attributename']); $i++) {
	    $service->CreateAttribute($res, $_POST['attributename'][$i], $_POST['attributetype'][$i]);
	  }
	  echo 'OK';	
	}
}

 else if ($_POST['action'] === 'update' && is_numeric($_POST['concept_id']) && !empty($_POST['concept_name'])) { // "update" is the submit action of "edit"
	$service = new Services();

	$id = intval($_POST['concept_id']);
	$concept_name = $_POST['concept_name'];

	$res = $service->UpdateConcept($_POST['concept_id'], $_POST['concept_name']);

	if (!$res) {
	  echo 'Error update MC test message!';
	} else {
	  
	  /*
	   * Logic to delete attributes
	   * 
	   * Deletes if:
	   *   - attributename is empty
	   *   - attribute field is removed
	   */
	  $attributeList = $service->ListAttributeConcept($res);
	  if($attributeList) {
	    foreach($attributeList as $attribute) {
	      $toDelete = false;
	      if(isset($_POST['attributename']) === false) {
		$toDelete = true;
	      } else {
		foreach($_POST['attributeid'] as $id) {
		  if($attribute->id == $id) {
		    $toDelete = false;
		    break;
		  }
		  $toDelete = true;
		}
	      }
	      if($toDelete) {
		$service->DeleteAttribute($attribute->id);
	      }
	    }
	  }
	  
	  /**
	   * Logic to add / edit attributes
	   */
	  if(isset($_POST['attributename'])) {
	    for ($i=0; $i<sizeof($_POST['attributename']); $i++) {
	      if (empty($_POST['attributename'][$i])) {
		if(isset($_POST['attributeid'][$i])) {
		  $service->DeleteAttribute($_POST['attributeid'][$i]);
		  unset($_POST['attributeid'][$i]);
		}
	      } else if(isset($_POST['attributeid'][$i]) && !empty($_POST['attributeid'][$i])) {		
		$service->UpdateAttribute($_POST['attributeid'][$i], $_POST['attributename'][$i], $_POST['attributetype'][$i]);
	      } else {
		$service->CreateAttribute($res, $_POST['attributename'][$i], $_POST['attributetype'][$i]);
	      }
	    }
	  }
	  
	  echo 'OK';
	}
}  else if ($_POST['action'] === 'delete') { 
	$service = new Services();
	$concept_id = intval($_POST['concept_id']);

	$res = $service->DeleteConcept($concept_id);

	if (!$res) {
		echo 'Could not delete Concept: ';
	} 
	else {
	echo 'OK';
	}
}
