<?php
require 'vendor/autoload.php';

$app = new \Slim\App();


$app->group('/api', function() use ($app) {
	require 'routes/champions.php';
	require 'routes/teams.php';
	require 'routes/compos.php';
	require 'routes/regions.php';
	require 'routes/bans.php';
	require 'routes/games.php';
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