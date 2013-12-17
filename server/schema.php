<?php

include('smarty/Smarty.class.php');
include('services.php');
include('common_functions.php');


// GUI for the schemas
if ($_POST['action'] === 'new') {

	// Call services
	$service = new Services();
	$concepts = $service->ListConcepts();

	// Create object
	$smarty = new Smarty;

	$list = array();
	// Assign values
	foreach ($concepts as $concept) {
		$list[] = array(
				'id' => $concept->id,
				'name' => $concept->name
			);
	}

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('concepts_list', $list);
	// display it
	$smarty->display('tpl/schema-new.tpl');
} 
// GUI for the conceptMaterialized update
else if ($_POST['action'] === 'edit' && is_numeric($_POST['schema_id'])) {

	// Call services
	$service = new Services();
		
	// Create object
	$smarty = new Smarty;

	$id = intval($_POST['schema_id']);
	
	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	//TODO
	// display it
	$smarty->display('tpl/schema-edit.tpl');
} else if ($_POST['action'] === 'update' && is_numeric($_POST['schema_id']) && !empty($_POST['schema_name'])) { // "update" is the submit action of "edit"
	$service = new Services();

	$id = intval($_POST['schema_id']);
	$schema_name = $_POST['schema_name'];

	//TODO $res = some call to a service
	if (!$res) {
		echo 'Error update MC test message!';
	} else {
		echo 'OK';
	}
} else if ($_POST['action'] === 'create') { // "create" is the submit action of "new"
	$service = new Services();

	$concept_id = intval($_POST['concept']);
	$schema_name = $_POST['schema_name'];
		
	//TODO $res = some call to a service
	if (!$res) {
		echo 'Error create MC test message!';
	} else {
		echo 'OK';
	}
} else if ($_POST['action'] === 'delete') { 
	$service = new Services();
	$schema_id = intval($_POST['schema_id']);

	//TODO $res = some call to a service
	if ($res) {
		echo 'OK';
	} else {
		echo 'Error delete MC test message! See logs.';
	}
}

?>