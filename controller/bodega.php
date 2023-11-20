<?php
    header('Content-Type: application/json') ;

    require_once("../config/conexion.php");
    require_once("../models/bodega.php");
    $categoria = new Categoria();

    $body = json_decode(file_get_contents("php://input"), true);

switch($_GET["op"]){
    case "GetAll":
        $datos=$categoria->get_bodega();
        echo json_encode($datos);
    break;
    case "Update":
        if (isset($body["codigo_producto"], $body["nombre"])) {
            $codigo_producto = $body["codigo_producto"];
            $nombre = $body["nombre"];
            $datos = $categoria->update_bodega($codigo_producto, $nombre);
            echo json_encode($datos);
        } else {
            $response = array("status" => "error", "message" => "Datos mal ingresados");
            echo json_encode($response);
        }
    break;
    case "Delete":
            $datos = $categoria->delete_bodega($body["codigo_producto"]);
            echo json_encode($datos);
    break;
        }
?>