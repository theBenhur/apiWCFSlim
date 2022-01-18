<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->get('/productos/detallesP/{categoria}', \App\Action\getAllProducts::class)/*->add(\App\Action\Auth::class)*/;
    $app->get('/productos/detalles/{isbn}', \App\Action\Detalle::class)/*->add(\App\Action\Auth::class)*/;
    $app->get('/usuarios/roles/',\App\Action\Rol::class);
    $app->get('/productos/{isbn}', \App\Action\getSingleProd::class);
    $app->post('/productos/{categoria}', \App\Action\setProducto::class);/*->add(\App\Action\Auth::class);*/
    $app->put('/productos/{isbn}', \App\Action\updateProducto::class)/*->add(\App\Action\Auth::class)*/;
    $app->delete('/productos/{isbn}', \App\Action\deleteProducto::class)/*->add(\App\Action\Auth::class)*/;
};
