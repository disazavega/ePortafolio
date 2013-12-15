<?php

include('smarty/Smarty.class.php');
include('services.php');
include('common_functions.php');

// Values for the tests
$_POST['action'] = 'update';
$_POST['cm_id'] = '1';
$_POST['alignment_id'] = '4';
$_POST['field_id'] = '2';
$_POST['attribute_id'] = '3';

// GUI for the Alignment main screen
if ($_POST['action'] === 'list' && is_numeric($_POST['cm_id'])) {
        
        // Call services
        $service = new Services();

	$matConcept = $service->RecoverMaterializedConcept($_POST['cm_id']);
  	$alignments = $service->ListAlignmentsMC($_POST['cm_id']);
      echo '<pre>';
      var_dump($alignments);
      echo '</pre>';
        
        // create object
	$smarty = new Smarty;
        
        $id = intval($_POST['cm_id']);

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
		'id' => $id, 
                'name' => sanitize($matConcept->name)
	));
        
	$list = array();
      //  $field = new Field();
      //  $attribute = new Attribute();
        
        // Assign values
        foreach ($alignments as $alignment) {
           $list[] = array(
                    'id' => $allignment->id,
     //             'name' => $aligName
                    'name' => $allignment->idField
             );
        }

        $smarty->assign('alignments_list', $list);

        echo 'before the display';    
	// display it - Nothing displayed...
	$smarty->display('tpl/alignment-list.tpl');
} else if ($_POST['action'] === 'edit' && is_numeric($_POST['alignment_id'])) {
	// create object
	$smarty = new Smarty;

	$id = intval($_POST['alignment_id']);

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
		'id' => $id,
	    'name' => sanitize($current_concept_name)
	));

	$list = array();
	$list2 = array();

	// TODO Replace this for loop by a for loop on the Services' return value...
	// listing the attributes and fields for the current alignment
	for ($i=1; $i < 5; $i++) { 
		$list[] = array(
			'id' => $i,
			'name' => "DummyAttribute{$i}"
		);
		$list2[] = array(
			'id' => $i,
			'name' => "DummyField{$i}"
		);
	}
	$smarty->assign('attributes_list', $list);
	$smarty->assign('fields_list', $list2);

	// display it
	$smarty->display('tpl/alignment-edit.tpl');

} else if ($_POST['action'] === 'update' && is_numeric($_POST['alignment_id']) && is_numeric($_POST['attribute_id']) && is_numeric($_POST['field_id'])) {
	$service = new Services();
	$alignment_id = intval($_POST['alignment_id']);
	$attr_id = intval($_POST['attribute_id']);
	$field_id = intval($_POST['field_id']);
	
        $res = $service->UpdateAlignment($alignment_id, $field_id, $attr_id);
        if (!$res) {
		echo 'Error update alignment test message!';
	} else {
		echo 'OK';
	}

} else if ($_POST['action'] === 'new' && is_numeric($_POST['cm_id'])) { /* we need the CM id in order to create an alignment, so that we can display the right options... */
	// Call services

        // create object
	$smarty = new Smarty;

	$id = intval($_POST['cm_id']);

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
		'id' => $id,
	    'name' => sanitize($current_concept_name)
	));

	$list = array();
	$list2 = array();

	// TODO Replace this for loop by a for loop on the Services' return value...
	// listing the attributes and fields for the current alignment
	for ($i=1; $i < 5; $i++) { 
		$list[] = array(
			'id' => $i,
			'name' => "DummyAttribute{$i}"
		);
		$list2[] = array(
			'id' => $i,
			'name' => "DummyField{$i}"
		);
	}
	$smarty->assign('attributes_list', $list);
	$smarty->assign('fields_list', $list2);

	// display it
	$smarty->display('tpl/alignment-new.tpl');
} else if ($_POST['action'] === 'create' 
	&& is_numeric($_POST['cm_id']) /* we need the CM id in order to create an alignment, so that we can display the right options... */
	&& is_numeric($_POST['attribute_id']) 
	&& is_numeric($_POST['field_id'])
	) {
    $service = new Services();
    
	$cm_id = intval($_POST['cm_id']);
	$attr_id = intval($_POST['attribute_id']);
	$field_id = intval($_POST['field_id']);
	
        $res = $service->CreateAlignment($cm_id, $field_id, $attr_id);
        if (!$res) {
		echo 'Error create alignemnt test message!';
	} else {
		echo 'OK';
	}
} else if ($_POST['action'] === 'delete') { // "create" is the submit action of "new"
	$service = new Services();
        $alignment_id = intval($_POST['alignment_id']);
        
        $res = $service->DeleteAlignment($alignment_id);
        if ($res) {
		echo 'OK';
	} else {
		echo 'Error delete alignment test message! Error is' . $service->get_error($res);
	}
}

?>