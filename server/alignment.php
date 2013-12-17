<?php

include('smarty/Smarty.class.php');
include('services.php');
include('common_functions.php');

// GUI for the Alignment main screen
if ($_POST['action'] === 'list' && is_numeric($_POST['cm_id'])) {
    // Call services
    $service = new Services();
    $cm_id = intval($_POST['cm_id']);
    $alignments = $service->ListAlignmentsMC($cm_id);
    
    // create object
	$smarty = new Smarty;
        
	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$list = array();
        
    // Assign values
    foreach ($alignments as $alignment) {
        $list[] = array(
                'id' => $alignment->id,
                'name' => sanitize("Dummie :D")
         );
    }

    $smarty->assign('alignments_list', $list);
	// display it 
	$smarty->display('tpl/alignment-list.tpl');
} else if ($_POST['action'] === 'edit' && is_numeric($_POST['alignment_id'])) {
    
    // Call services
    $service = new Services();
    $alignment_id = intval($_POST['alignment_id']);
// TO DO : Add the form id
    $form_id = intval("1");
        
    //Load
    $this_alignment = $service->RecoverAlignment($alignment_id);
    $cm_id = intval($this_alignment->idConceptMaterialized);
    $attributes = $service->ListAttributesConceptMaterialized($cm_id);
    $fields = $service->ListFieldsForm($form_id);
//      echo '<pre>';
//      var_dump($fields);
//      echo '</pre>';

    // create object
    $smarty = new Smarty;
    
    //First smarty assing

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
        // Normaly thats no the
	$smarty->assign('cm', array(
		'id' => $this_alignment->id,
	    'name' => sanitize("No Name right ?")
	));

	$list_fields = array();
	$list_attributes = array();
        
        //Assignation field
        foreach ($fields as $field) {
            $list_fields[] = array(
		'id' => $field->id,
		'name' => sanitize($field->name),
                'checked' => ($field->id === $this_alignment->idField) ? "checked='checked'" : ""
            );
        }
        
        //Assignation attributes
        foreach ($attributes as $attribute) {
            $list_attributes[] = array(
                'id' => $attribute->id,
                'name' => sanitize($attribute->name),
                'checked' => ($attribute->id === $this_alignment->idAttribute) ? "checked='checked'" : ""
            );
        }
	$smarty->assign('attributes_list', $list_attributes);
	$smarty->assign('fields_list', $list_fields);

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
    $service = new Services();
    $alignment_id = intval($_POST['alignment_id']);
    $cm_id = intval($_POST['cm_id']);
// TO DO : Add the form id
    $form_id = intval("1");
        
    //Load
    $this_alignment = $service->RecoverAlignment($alignment_id);
    $attributes = $service->ListAttributesConceptMaterialized($cm_id);
    $fields = $service->ListFieldsForm($form_id);

        // create object
	$smarty = new Smarty;

	$id = intval($_POST['cm_id']);

	$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
	$smarty->assign('cm', array(
		'id' => $id,
	    'name' => sanitize("Normaly there s no name, right !")
	));

	$list_fields = array();
	$list_attributes = array();
        
        //Assignation field
        foreach ($fields as $field) {
            $list_fields[] = array(
		'id' => $field->id,
		'name' => sanitize($field->name)
            );
        }
        
        //Assignation attributes
        foreach ($attributes as $attribute) {
            $list_attributes[] = array(
                'id' => $attribute->id,
                'name' => sanitize($attribute->name)
            );
        }
	$smarty->assign('attributes_list', $list_attributes);
	$smarty->assign('fields_list', $list_fields);

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