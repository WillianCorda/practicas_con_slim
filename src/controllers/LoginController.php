<?php
class LoginController{

    public function mostrarLogin($req, $res, $args){
        $html=file_get_contents(__DIR__. '/../views/login.html');
        $res->getBody()->write($html);
        return $res->withHeader('Content-Type', 'text/html');

    }
    


}