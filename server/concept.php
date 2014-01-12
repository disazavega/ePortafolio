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
  
  $concepts = $service->ListConceptById($id);
  $list = array();
  
  //Assigning Values
  foreach ($concepts as $concept) {
    $list = array(
	    'id' => $concept->id,
	    'name' => $concept->name
	  );
  }
  
  $smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
//  $smarty->assign('concepts_list',$list);
  $smarty->display('tpl/concept-edit.tpl');
  
}

else if ($_POST['action'] === 'create') { // "create" is the submit action of "new"
	$service = new Services();

	$concept_name = $_POST['concept_name'];
	
	//storing concept	
	$res = $service->CreateConcept($_POST['schema_id'], $_POST['concept_name']);

	if (!$res) {
		echo 'Error create Schema instance!';
	}

	//storing concept for concept
	//TODO: to be cleared if it is fine!!!
	//$res = $service->CreateConcept($res, $_POST['concept_name']);

	if (!$res) {
		echo 'Error create Concept (Schema)!';
	}
	else{
		echo 'OK';	
	}
}
