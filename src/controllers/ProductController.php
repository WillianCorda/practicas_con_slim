<?php

class ProductController {

    public function mostrarProductos($req, $res, $args) {
        if (!isset($_SESSION['productos'])) {
            $_SESSION['productos'] = [
                ['id' => 1, 'nombre' => 'Camiseta Negra', 'precio' => 2999.99, 'categoria' => 'Ropa'],
                ['id' => 2, 'nombre' => 'Zapatillas Urbanas', 'precio' => 12500.00, 'categoria' => 'Calzado'],
                ['id' => 3, 'nombre' => 'Auriculares Bluetooth', 'precio' => 8499.50, 'categoria' => 'Electrónica'],
            ];
        }

        $lista = "";

        foreach ($_SESSION['productos'] as $producto) {
            $id = $producto['id'];
            $nombre = htmlspecialchars($producto['nombre']);
            $precio = htmlspecialchars($producto['precio']);
            $categoria = htmlspecialchars($producto['categoria']);

            $lista .= "
            <li class='list-group-item'>
                <div class='d-flex justify-content-between align-items-center'>
                    <div>
                        <strong>$nombre</strong> - $categoria<br>
                        <small class='text-muted'>\$$precio</small>
                    </div>
                    <div class='d-flex gap-2'>
                        <!-- 🔧 Botón para eliminar -->
                        <form method='POST' action='/eliminar-producto'>
                            <input type='hidden' name='id' value='$id'>
                            <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                        </form>

                        <!-- 🔧 Botón para modificar -->
                        <form method='POST' action='/modificar-producto'>
                            <input type='hidden' name='id' value='$id'>
                            <input type='hidden' name='nombre' value='$nombre'>
                            <input type='hidden' name='precio' value='$precio'>
                            <input type='hidden' name='categoria' value='$categoria'>
                            <button type='submit' class='btn btn-warning btn-sm'>Modificar</button>
                        </form>
                    </div>
                </div>
            </li>";
        }

        $template = file_get_contents(__DIR__ . "/../views/productos.html");
        $htmlFinal = str_replace('{{productos}}', $lista, $template);
        $res->getBody()->write($htmlFinal);
        return $res;
    }

    // 🔧 CREAR producto
    public function crearProducto($req, $res, $args) {
        $data = $req->getParsedBody();
        $nuevo = [
            'id' => count($_SESSION['productos']) + 1,
            'nombre' => $data['nombre'],
            'precio' => $data['precio'],
            'categoria' => $data['categoria']
        ];
        $_SESSION['productos'][] = $nuevo;
        return $res->withHeader('Location', '/productos')->withStatus(302);
    }

    // 🔧 ELIMINAR producto
    public function eliminarProducto($req, $res, $args) {
        $id = $req->getParsedBody()['id'];
        foreach ($_SESSION['productos'] as $i => $p) {
            if ($p['id'] == $id) {
                unset($_SESSION['productos'][$i]);
                break;
            }
        }
        $_SESSION['productos'] = array_values($_SESSION['productos']);
        return $res->withHeader('Location', '/productos')->withStatus(302);
    }

    // 🔧 MODIFICAR producto (simplemente lo reenviamos a un formulario de edición)
   public function modificarProducto($req, $res, $args) {
    // 🔧 Muestra el formulario de edición
    $data = $req->getParsedBody();
    $id = $data['id'];
    $nombre = $data['nombre'];
    $precio = $data['precio'];
    $categoria = $data['categoria'];

    // Formulario HTML precargado
    $form = "
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Editar producto</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
        <div class='container mt-5'>
            <h2 class='mb-4 text-primary text-center'>Modificar Producto</h2>
            <form method='POST' action='/actualizar-producto' class='row g-3'>
                <input type='hidden' name='id' value='$id'>
                <div class='col-md-4'>
                    <input type='text' class='form-control' name='nombre' value='$nombre' required>
                </div>
                <div class='col-md-3'>
                    <input type='number' step='0.01' class='form-control' name='precio' value='$precio' required>
                </div>
                <div class='col-md-3'>
                    <input type='text' class='form-control' name='categoria' value='$categoria' required>
                </div>
                <div class='col-md-2 d-grid'>
                    <button type='submit' class='btn btn-warning'>Actualizar</button>
                </div>
            </form>
            <div class='mt-3 text-center'>
                <a href='/productos' class='btn btn-secondary'>Cancelar</a>
            </div>
        </div>
    </body>
    </html>";

    $res->getBody()->write($form);
    return $res;
}

// 🔧 Nueva función para aplicar la modificación
public function actualizarProducto($req, $res, $args) {
    $data = $req->getParsedBody();
    $id = $data['id'];

    foreach ($_SESSION['productos'] as &$producto) {
        if ($producto['id'] == $id) {
            // Actualizamos los valores
            $producto['nombre'] = $data['nombre'];
            $producto['precio'] = $data['precio'];
            $producto['categoria'] = $data['categoria'];
            break;
        }
    }
    return $res->withHeader('Location', '/productos')->withStatus(302);
}

    
}
