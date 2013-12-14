<?php

include('smarty/Smarty.class.php');

if ($_POST['action'] === 'list' && is_numeric($_POST['cm_id'])) {
	
	// create object
	$smarty = new Smarty;

	$id = intval($_POST['cm_id']);

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
		'id' => $id, 
	    'name' => sanitize($current_concept_name)
	));

	$list = array();

	// TODO Replace this for loop by a for loop on the Services' return value...
	// listing the alignments for the current materialized concept
	for ($i=1; $i < 5; $i++) { 
		$list[] = array(
			'id' => $i,
			'name' => "DummyName{$i}"
		);
	}
	$smarty->assign('alignments_list', $list);

	// display it
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

} else if ($_POST['action'] === 'update' && is_numeric($_POST['alignment_id'] && is_numeric($_POST['attribute_id']) && is_numeric($_POST['field_id'])) {
	// TODO: Use the services to update the information about the materialized concept
	$alignment_id = intval($_POST['alignment_id']);
	$attr_id = intval($_POST['attribute_id']);
	$field_id = intval($_POST['field_id']);
	// This is dummy code, to be removed, it just shows how you can send an error message or just ACK the request:
	if ($attr_id !== 2) {
		echo 'Error test message!';
	} else {
		echo 'OK';
	}

} else if ($_POST['action'] === 'new' && is_numeric($_POST['cm_id'])) { /* we need the CM id in order to create an alignment, so that we can display the right options... */
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
	// TODO: Use the services to update the information about the materialized concept
	$cm_id = intval($_POST['cm_id']);
	$attr_id = intval($_POST['attribute_id']);
	$field_id = intval($_POST['field_id']);
	// This is dummy code, to be removed, it just shows how you can send an error message or just ACK the request:
	if ($attr_id !== 2) {
		echo 'Error test message!';
	} else {
		echo 'OK';
	}
} else if ($_POST['action'] === 'delete') { // "create" is the submit action of "new"
	// TODO: Use the services to actually delete the materialized concept
	$alignment_id = intval($_POST['alignment_id']);

	// This is dummy code, to be removed, it just shows how you can send an error message or just ACK the request:
	if ($alignment_id !== 2) {
		echo 'Error test message!';
	} else {
		echo 'OK';
	}
}

?>