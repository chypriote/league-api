<?php

	$container = $app->getContainer();

	$container['renderer'] = function($c) {
		return new Slim\Views\PhpRenderer('site/templates/');
	};

	$app->get('', function($req, $res, $args) {

		return $this->renderer->render($res, 'index.phtml', $args);
	});

	$app->get('public/{file}', function($req, $res, $args) {
		return $file;
	});