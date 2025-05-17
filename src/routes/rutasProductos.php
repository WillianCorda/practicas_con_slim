<?php

$app->group('', function($group) {
    $group->get('/productos', [ProductController::class, 'mostrarProductos']);
    $group->post('/crear-producto', [ProductController::class, 'crearProducto']);
    $group->post('/eliminar-producto', [ProductController::class, 'eliminarProducto']);
    $group->post('/modificar-producto', [ProductController::class, 'modificarProducto']);
    $group->post('/actualizar-producto', [ProductController::class, 'actualizarProducto']);

});
