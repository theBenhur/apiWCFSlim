<?php

use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {
    $app->addBodyParsingMiddleware();

    $app->addRoutingMiddleware();

    $app->add(new BasePathMiddleware($app));
};