<?php

require_once '../models/Venta.php';


if(isset($_GET['op'])){

    $ventas = new Ventas();

    if ($_GET['op'] == 'productos_listar_ventas') {
        $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    
        $data = $ventas->productos_listar_ventas($filtro);
    
        if ($data) {
            foreach ($data as $listar) {
                $nombreProducto = $listar['nombreproducto'];
                $idProducto = $listar['idproducto'];
    
                // Obtener las dos primeras letras del nombre del producto
                $dosPrimerasLetras = substr($nombreProducto, 0, 2);
    
                echo "
                    <tr>
                        <td>
                            <img src='https://dummyimage.com/40x40/999999/ffffff&text=$dosPrimerasLetras' alt='Avatar' style='border-radius: 50%; width: 35px; height: 30px;'>
                            <span class='id-lista'>$idProducto</span>
                        </td>
                        <td>{$listar['nombreproducto']}</td>
                        <td>{$listar['nombrecategoria']}</td>
                        <td>{$listar['stock']}</td>
                        <td>{$listar['precio']}</td>
                        <td>{$listar['fechavencimiento']}</td>
                        <td>{$listar['recetamedica']}</td>                                    
                        <td>                
                            <a class='editar-product btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#modal-agregarP' data-idproducto ='{$listar['idproducto']}'><i class='bi bi-check-circle'></i></a>
                        </td>
                    </tr>";
            }
        }
    }

    

    
    if ($_GET['op'] == 'lista_productos') {

        $data = $ventas->lista_productos();

        if ($data) {
            foreach ($data as $listar) {
                $nombreProducto = $listar['nombre_producto'];

                // Obtener las dos primeras letras del nombre del producto
                $dosPrimerasLetras = substr($nombreProducto, 0, 2);

                echo "
                <tr>
                    <td>
                        <img src='https://dummyimage.com/40x40/999999/ffffff&text=$dosPrimerasLetras' alt='Avatar' style='border-radius: 50%;  width: 35px; height: 30px;''>
                        <span class='id-lista'>{$listar['iddetalleventa']}</span>
                    </td>
                    <td>{$listar['nombre_producto']}</td>
                    <td>{$listar['nombre_usuario']}</td>
                    <td>{$listar['cantidad']}</td>
                    <td>{$listar['unidadproducto']}</td>
                    <td>{$listar['preciototal']}</td>
                    <td>
                    <a class='eliminar-product btn btn-danger btn-sm eliminar-fila' data-iddetalleventa ='{$listar['iddetalleventa']}' ><i class='bi bi-trash'></i></a>
                    </td>                                          
                </tr>";
            }
        }
    }

}


if(isset($_POST['op'])){
    $ventas = new Ventas();

    if($_POST['op'] == 'registrar_producto_lista'){
        $data = [
            "idproducto"       => $_POST['idproducto'],
            "cantidad"    => $_POST['cantidad'],
        ];

        $respuesta = $ventas->agregar_producto($data);
        echo json_encode($respuesta);
    }

    if($_POST['op'] == 'productos_listar_id'){

            $idproducto = $_POST['idproducto'];
    
            $respuesta = $ventas->productos_listar_id($idproducto);
            echo json_encode($respuesta);
       
    }


    if($_POST['op'] == 'eliminarProducto'){
        $data = [
            "iddetalleventa"       => $_POST['iddetalleventa'],
        ];

        $respuesta = $ventas->eliminar_Producto($data);
        echo json_encode($respuesta);
    }


}