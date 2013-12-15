<?php

include('smarty/Smarty.class.php');
include('services.php');

//      Test values
/*      $_POST['action'] = 'delete';
        $_POST['cm_id'] = '4';
        $_POST['concept'] = '2';
        $_POST['cm_name'] = 'MC Test3';
 */
        

function sanitize($string)
{
	return str_replace("'", "\'", $string);
}

// GUI for the materialization (conceptMaterialized creation)
if ($_POST['action'] === 'new') {

        // Call services
	$service = new Services();
	$concepts = $service->ListConcepts();
	
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
    	
    $matConcept = $service->RecoverMaterializedConcept($_POST['cm_id']);
        
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
            'checked' => ($concept->id === $matConcept->idConcept) ? "checked='checked'" : ""
 		);
	 } 

	$smarty->assign('concepts_list', $list);

	// display it
	$smarty->display('tpl/concept-mat-edit.tpl');
} else if ($_POST['action'] === 'update' && is_numeric($_POST['cm_id']) && !empty($_POST['cm_name'])) { // "update" is the submit action of "edit"
	$service = new Services();

	$id = intval($_POST['cm_id']);
	$concept_id = intval($_POST['concept']);
	$cm_name = $_POST['cm_name'];

	$res = $service->UpdateMaterializedConcept($id, $cm_name, $concept_id);
	if (!$res) {
		echo 'Error update MC test message!';
	} else {
		echo 'Update MC OK';
	}
} else if ($_POST['action'] === 'create') { // "create" is the submit action of "new"
        $service = new Services();
    
        $concept_id = intval($_POST['concept']);
	$cm_name = $_POST['cm_name'];
        
        // TODO -  Add the id Form
        $form_id = intval('1');

	$res = $service->MaterializeConcept($form_id, $concept_id, $cm_name);
        if (!$res) {
		echo 'Error create MC test message!';
	} else {
		echo 'Create MC OK';
	}
} else if ($_POST['action'] === 'delete') { 
	$service = new Services();
        $cm_id = intval($_POST['cm_id']);

	$res = $service->UnMaterializeConcept($cm_id);
        if (! $res) {
                echo 'Delete MC OK';
	} else {
		echo 'Error delete MC test message!';
	}
}

?>