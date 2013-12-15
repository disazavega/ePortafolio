<?php

include('smarty/Smarty.class.php');
include('services.php');

// Values for the tests
$_POST['action'] = 'edit';
$_POST['cm_id'] = '1';

function sanitize($string)
{
	return str_replace("'", "\'", $string);
}

// GUI for the materialization (conceptMaterialized creation)
if ($_POST['action'] === 'new') {

        // Call services
	$service = new Services();
	$concepts = $service->ListConcepts();
//	echo '<pre>';
//	var_dump($concepts);
//	echo '</pre>';
	
	// Create object
	$smarty = new Smarty;

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
	    'name' => sanitize($current_concept_name)
	));
	$list = array();

	// Assign values
	foreach ($concepts as $concept) {
	 	$list[] = array(
	 			'id' => $concept->id,
	 			'name' => $concept->name
	 		);
	 } 

        // Assign concepts    
	$smarty->assign('concepts_list', $list);
	// display it
	$smarty->display('tpl/concept-mat-new.tpl');

} 

// GUI for the conceptMaterialized update
else if ($_POST['action'] === 'edit' && is_numeric($_POST['cm_id'])) {

        // Call services
        $service = new Services();
	$concepts = $service->ListConcepts();
//      echo '<pre>';
//	var_dump($concepts);
//      echo '</pre>';
    	
        $matConcept = $service->RecoverMaterializedConcept($_POST['cm_id']);
//	echo '<pre>';
//	var_dump($matConcept);
//      echo '</pre>';
        
        // Create object
	$smarty = new Smarty;

	$id = intval($_POST['cm_id']);
	
	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
		'id' => $id,
	    'name' => sanitize($matConcept->name)
	));

	$list = array();

        // Assign values
	foreach ($concepts as $concept) {
	 	$list[] = array(
	 			'id' => $concept->id,
	 			'name' => $concept->name,
                                'checked' => ($concept->id === $matConcept->idConcept ) ? "checked" : ""
	 		);
	 } 

	$smarty->assign('concepts_list', $list);

	// display it
	$smarty->display('tpl/concept-mat-edit.tpl');
} else if ($_POST['action'] === 'update' && is_numeric($_POST['cm_id'])) { // "update" is the submit action of "edit"
	// TODO: Use the services to update the information about the materialized concept
	$id = intval($_POST['cm_id']);
	// This is dummy code, to be removed, it just shows how you can send an error message or just ACK the request:
	$test = intval($_POST['materialized_concept']);
	if ($test !== 2) {
		echo 'Error test message!';
	} else {
		echo 'OK';
	}
} else if ($_POST['action'] === 'create') { // "create" is the submit action of "new"
	// TODO: Use the services to actually create the materialized concept
	$concept_id = intval($_POST['materialized_concept']);
	$cm_name = intval($_POST['cm_name']);

	// This is dummy code, to be removed, it just shows how you can send an error message or just ACK the request:
	if ($concept_id !== 2) {
		echo 'Error test message!';
	} else {
		echo 'OK';
	}
} else if ($_POST['action'] === 'delete') { 
	// TODO: Use the services to actually delete the materialized concept
	$cm_id = intval($_POST['cm_id']);

	// This is dummy code, to be removed, it just shows how you can send an error message or just ACK the request:
	if ($cm_id !== 2) {
		echo 'Error test message!';
	} else {
		echo 'OK';
	}
}

?>