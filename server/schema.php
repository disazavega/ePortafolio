<?php

include('smarty/Smarty.class.php');
include('services.php');
include('common_functions.php');


// GUI for the schemas	
if ($_POST['action'] === 'new') {

	// Call services
	$service = new Services();
	$schemas = $service->ListSchemas();

	// Create object
	$smarty = new Smarty;

	$list = array();
	// Assign values
	foreach ($schemas as $schema) {
		$list[] = array(
				'id' => $schema->id,
				'name' => $schema->name
			);
	}

	//getting concepts:
// 	$concepts = $service->ListConcepts();
 	$concepts_list = array();
// 	foreach($concepts as $concept){
// 		$concepts_list[] = array(
// 			'id' => $concept->id,
// 			'name' => $concept->name
// 		);
// 	}

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	//$smarty->assign('schemas_list', $list);
	$smarty->assign('concepts_list', $concepts_list);
	// display it
	$smarty->display('tpl/schema-new.tpl');
} 
// GUI for the schema update
else if ($_POST['action'] === 'edit' && is_numeric($_POST['schema_id'])) {


	// Call services
	$service = new Services();
		
	// Create object
	$smarty = new Smarty;

	$id = intval($_POST['schema_id']);
	
	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	//getting schema by id:
	$schema = $service->ListSchemaById($id);

	//getting concepts
	
	$concepts = $service->ListConceptsBySchemaId($id);
	
	
	$concepts_list = array();
	foreach($concepts as $concept){
		$concepts_list[] = array(
			'id' => $concept->id,
			'name' => $concept->name
		);
	}
	$smarty->assign('concepts_list', $concepts_list);

	$smarty->assign('schema', array(
		'id' => $schema->id,
		'name' => sanitize($schema->name),
		'author' => sanitize($schema->author),
		'date' => sanitize($schema->createdAt)
	));
	


	// display it
	$smarty->display('tpl/schema-edit.tpl');
} else if ($_POST['action'] === 'update' && is_numeric($_POST['schema_id']) && !empty($_POST['schema_name'])) { // "update" is the submit action of "edit"
	$service = new Services();

	$id = intval($_POST['schema_id']);
	$schema_name = $_POST['schema_name'];

	$res = $service->UpdateSchema($_POST['schema_id'], $_POST['schema_name'], $_POST['schema_author']);

	//TODO: handle concepts

	if (!$res) {
		echo 'Error update MC test message!';
	} else {
		echo 'OK';
	}
} else if ($_POST['action'] === 'create') { // "create" is the submit action of "new"
	$service = new Services();

	$schema_name = $_POST['schema_name'];
	
	//storing schema	
	$res = $service->CreateSchema($_POST['schema_name'], $_POST['schema_author']);

	if (!$res) {
		echo 'Error create Schema instance!';
	}

	//storing concept for schema
	//TODO: to be cleared if it is fine!!!
	//$res = $service->CreateConcept($res, $_POST['concept_name']);

	if (!$res) {
		echo 'Error create Concept (Schema)!';
	}
	else{
		echo 'OK';	
	}
} else if ($_POST['action'] === 'delete') { 
	$service = new Services();
	$schema_id = intval($_POST['schema_id']);

	$res = $service->DeleteSchema($schema_id);

	if (!$res) {
		echo 'Could not delete Schema: ';
	} 
	else {
	echo 'OK';
	}
}

?>
