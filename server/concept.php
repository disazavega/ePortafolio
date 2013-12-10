<?php

include('smarty/Smarty.class.php');

function sanitize($string)
{
	return str_replace("'", "\'", $string);
}

if ($_POST['action'] === 'edit') {
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
	$smarty->display('tpl/concept-mat-edit.tpl');
}

?>