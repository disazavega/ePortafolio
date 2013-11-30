<?php

include('smarty/Smarty.class.php');

// create object
$smarty = new Smarty;

$smarty->assign('BASE_URL', 'http://127.0.0.1:8080');
$smarty->assign('history', array(
    array('name' => 'bob', 'date' => '28-02-2013'),
    array('name' => 'jim', 'date' => '31-03-2013'),
    array('name' => 'joe', 'date' => '23-03-2013'),
    array('name' => 'jerry', 'date' => '23-03-2012'),
    array('name' => 'fred', 'date' => '23-03-2011')
    ));

// display it
$smarty->display('tpl/home.tpl');


?>
