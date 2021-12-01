<?php
function db()
{
	$database = 'test_up_app';
	$user = 'root';
	$pass = 'root';
	$port = 8889;

	try {
		return new PDO('mysql:host=localhost;port=' . $port . ';dbname=' . $database, $user, $pass);
	} catch (PDOException $e) {
		print "Error! " . $e->getMessage() . "<br/>";
		die();
	}
}
