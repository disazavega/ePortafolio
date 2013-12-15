<?php

/*
 * Common functions for the differents templates
 */

function sanitize($string)
{
	return str_replace("'", "\'", $string);
}

?>