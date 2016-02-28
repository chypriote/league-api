<?php
if (PHP_SAPI == 'cli-server') {
		$file = __DIR__ . $_SERVER['REQUEST_URI'];
		if (is_file($file)) {
				return false;
		}
}

require 'vendor/autoload.php';
session_start();
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

require 'config.php';
require 'dependencies.php';

function getConnection() {
	global $server, $database, $user, $password;

	$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

$app->group('/', function() use ($app) {
	require 'site/routes/site.php';
});

$app->group('/api', function() use ($app) {
	require 'api/routes/champions.php';
	require 'api/routes/teams.php';
	require 'api/routes/compos.php';
	require 'api/routes/regions.php';
	require 'api/routes/bans.php';
	require 'api/routes/games.php';
});

$app->run();