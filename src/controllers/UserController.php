<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class UserController{

    public function controladorUsuarios($request, $response, $args)
    {
        $response->getBody()->write("ESTE ES EL CONTROLADOR DE USUARIOS");
        return $response;
    }
    public function controladorVerUsuario($request, $response, $args)
    {
        $id = $args['id'];
        $response->getBody()->write("VER USUARIO {$id}");
        return $response;
    }
  


}