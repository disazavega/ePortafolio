<?php

include('smarty/Smarty.class.php');

if ($_POST['action'] === 'edit') {
	// create object
	$smarty = new Smarty;

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
	    'name' => str_replace("'", "\'", 'Bonjour')
	));

	// display it
	$smarty->display('tpl/concept-mat-edit.tpl');
}

?>