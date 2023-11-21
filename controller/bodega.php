<?php
header('Content-Type: application/json');

require_once("../config/conexion.php");
require_once("../models/bodega.php");

$categoria = new Categoria();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["op"]) {
    case "GetAll":
        $datos = $categoria->get_bodega();
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
        $datos = $categoria->delete_bodega($body["id_ventas"]);
        echo json_encode($datos);
        break;
    case "Vender":
        if (isset($body["codigo_producto"], $body["cantidad"])) {
            $codigo_producto = $body["codigo_producto"];
            $cantidad = $body["cantidad"];
            $venta_exitosa = $categoria->vender_producto($codigo_producto, $cantidad);

            if ($venta_exitosa) {
                $response = array("status" => "success", "message" => "Venta realizada con éxito");
                echo json_encode($response);
            } else {
                $response = array("status" => "error", "message" => "No se pudo realizar la venta");
                echo json_encode($response);
            }
        } else {
            $response = array("status" => "error", "message" => "Datos mal ingresados");
            echo json_encode($response);
        }
        break;
        case "Comprar":
            if (isset($body["codigo_producto"], $body["cantidad"])) {
                $codigo_producto = $body["codigo_producto"];
                $cantidad = $body["cantidad"];
                $compra_exitosa = $categoria->comprar_producto($codigo_producto, $cantidad);
                if ($compra_exitosa) {
                    $response = array("status" => "success", "message" => "Compra realizada con éxito");
                    echo json_encode($response);
                } else {
                    $response = array("status" => "error", "message" => "No se pudo realizar la compra");
                    echo json_encode($response);
                }
            } else {
                $response = array("status" => "error", "message" => "Datos mal ingresados");
                echo json_encode($response);
            }
            break;
            case "Producto":
                if (
                    isset($body["nombre"], $body["precio"], $body["fecha_vencimiento"], $body["cantidad_stock"])
                    && $body["nombre"] !== null
                    && $body["precio"] !== null
                    && $body["fecha_vencimiento"] !== null
                    && $body["cantidad_stock"] !== null
                ) {
                    $resultado = $categoria->post_productos(
                        $body["nombre"],
                        $body["precio"],
                        $body["fecha_vencimiento"],
                        $body["cantidad_stock"]
                    );
                    echo json_encode($resultado);
                } else {
                    echo json_encode(["status" => "error", "message" => "Campos requeridos no presentes o nulos"]);
                }
                break;
                    case "GetV":
                        $datos = $categoria->get_ventas();
                        echo json_encode($datos);
                    break;
                    case "GetC":
                        $datos = $categoria->get_compra();
                        echo json_encode($datos);
                    break;

                    case "GetFechaV":
                        $datos = $categoria->fecha_venta($body["fecha_venta"]);
                        echo json_encode($datos);
                        break;

                    case "GetFechaC":
                        $datos = $categoria->fecha_compra($body["fecha_compra"]);
                        echo json_encode($datos);
                        break;
            }

?>
