<?php

include('smarty/Smarty.class.php');

function sanitize($string)
{
	return str_replace("'", "\'", $string);
}

if ($_POST['action'] === 'new') {
	// create object
	$smarty = new Smarty;

	$current_concept_name = "Bonjour"; // TODO: Get that from services

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
	    'name' => sanitize($current_concept_name)
	));

	$list = array();

	// TODO Replace this for loop by a for loop on the Services' return value...
	for ($i=1; $i < 5; $i++) { 
		$list[] = array(
			'id' => $i,
			'name' => "DummyName{$i}"
		);
	}

	$smarty->assign('concepts_list', $list);

	// display it
	$smarty->display('tpl/concept-mat-new.tpl');

} else if ($_POST['action'] === 'edit' && is_numeric($_POST['cm_id'])) {
	
	// create object
	$smarty = new Smarty;

	$id = intval($_POST['cm_id']);
	$current_concept_name = "Bonjour"; // TODO: Get that from services

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
		'id' => $id,
	    'name' => sanitize($current_concept_name)
	));

	$list = array();

	// TODO Replace this for loop by a for loop on the Services' return value...
	for ($i=1; $i < 5; $i++) { 
		$list[] = array(
			'id' => $i,
			'name' => "DummyName{$i}",
			'checked' => ($i === 2) ? "checked" : "" 	// TODO: Put "checked" when this is the right
														// concept that is linked to the current materialized concept,
														// empty string for other ones
		);
	}

	$smarty->assign('concepts_list', $list);

	// display it
	$smarty->display('tpl/concept-mat-edit.tpl');
} else if ($_POST['action'] === 'update' && is_numeric($_POST['cm_id'])) {
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
} else if ($_POST['action'] === 'delete') { // "create" is the submit action of "new"
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