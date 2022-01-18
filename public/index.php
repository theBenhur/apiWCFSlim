<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
(require '../config/routes.php')($app);
(require '../config/middleware.php')($app);

$app->run();
