<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

require 'database.utils.php';

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
	global $server, $database, $user, $password;

	$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>