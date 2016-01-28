<?php
require 'vendor/autoload.php';

$app = new \Slim\App();


$app->group('/api', function() use ($app) {
	require 'Routes/champions.php';
	require 'Routes/teams.php';
});

$app->run();

function getConnection() {
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="league";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>