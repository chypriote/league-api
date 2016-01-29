<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

require 'config.php';
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