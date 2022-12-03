<?php

$mysqli = null;

function conn() {
	$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
	return $mysqli;
}

?>