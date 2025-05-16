<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app->group('/usuarios', function ($group) {
    $group->get('', [UserController::class, 'controladorUsuarios']);
    $group->get('/{id}', [UserController::class, 'controladorVerUsuario']);//->setName('usuarios') alias para hacer redireccionar desde otros lugares.
    
});



