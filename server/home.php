<?php

include('smarty/Smarty.class.php');
include('services.php');

// create object
$smarty = new Smarty;

$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
$smarty->assign('longerhistory', array(
    array('name' => 'bob', 'date' => '28-02-2013'),
    array('name' => 'jim', 'date' => '31-03-2013'),
    array('name' => 'joe', 'date' => '23-03-2013'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'fred', 'date' => '23-03-2011')
));

$smarty->assign('history', array(
    array('name' => 'bob', 'date' => '28-02-2013'),
    array('name' => 'jim', 'date' => '31-03-2013'),
    array('name' => 'joe', 'date' => '23-03-2013'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'fred', 'date' => '23-03-2011')
));

$service = new Services();
$materialized_concepts_data = $service->ListMaterializedConceptsForm(1);
$schema_list_data = $service->ListSchemas();

$materialized_concepts_list = array();
foreach ($materialized_concepts_data as $c) {
    $materialized_concepts_list[] = array('name' => $c->name, 'id' => $c->id);
}

$schema_list = array();
foreach ($schema_list_data as $c) {
    $schema_list[] = array('name' => $c->name, 'id' => $c->id);
}

$smarty->assign('materialized_concepts_list', $materialized_concepts_list);
$smarty->assign('schema_list', $schema_list);

// display it
$smarty->display('tpl/home.tpl');


?>
