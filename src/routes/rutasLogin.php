<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->group('', function($group){
 $group->get('/login', [LoginController::class, 'mostrarLogin']);
 $group->get('/hola', function ($requ, $res, $args){
    $hola ="hola";
    $res -> getBody()->write($hola);
    return $res;
 });
});
