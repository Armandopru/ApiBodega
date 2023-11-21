<?php
class Categoria extends Conectar {
    public function get_bodega() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `productos`";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update_bodega($codigo_producto, $nombre) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE productos SET nombre=? WHERE codigo_producto=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $codigo_producto);
        $sql->execute();
        return true;
    }
    public function delete_bodega($id_ventas) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM ventas WHERE id_ventas=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_ventas);
        $sql->execute();
        return true;
    }
    public function vender_producto($codigo_producto, $cantidad) {
        $conectar = parent::conexion();
        parent::set_names();
        try {
            $conectar->beginTransaction();
            $sql_select_stock = "SELECT cantidad_stock FROM productos WHERE codigo_producto=?";
            $stmt_select_stock = $conectar->prepare($sql_select_stock);
            $stmt_select_stock->bindValue(1, $codigo_producto);
            $stmt_select_stock->execute();
            $stock_actual = $stmt_select_stock->fetchColumn();
            if ($stock_actual >= $cantidad) {
                $nuevo_stock = $stock_actual - $cantidad;
                $sql_update_stock = "UPDATE productos SET cantidad_stock=? WHERE codigo_producto=?";
                $stmt_update_stock = $conectar->prepare($sql_update_stock);
                $stmt_update_stock->bindValue(1, $nuevo_stock);
                $stmt_update_stock->bindValue(2, $codigo_producto);
                $stmt_update_stock->execute();
                $fecha_venta = date("Y-m-d H:i:s");
                $sql_insert_venta = "INSERT INTO ventas (fecha_venta, cantidades_vendidas, fk_producto) VALUES (?, ?, ?)";
                $stmt_insert_venta = $conectar->prepare($sql_insert_venta);
                $stmt_insert_venta->bindValue(1, $fecha_venta);
                $stmt_insert_venta->bindValue(2, $cantidad);
                $stmt_insert_venta->bindValue(3, $codigo_producto);
                $stmt_insert_venta->execute();
                $conectar->commit();
                return true;
            } else {
                throw new Exception("No hay suficiente stock para realizar la venta.");
            }
        } catch (Exception $e) {
            $conectar->rollBack();
            return false;
        }
    }
    public function comprar_producto($codigo_producto, $cantidad_Compra) {
        $conectar = parent::conexion();
        parent::set_names();
        $conectar->beginTransaction();
        try {
        $sql_select_stock = "SELECT cantidad_stock FROM productos WHERE codigo_producto=?";
        $stmt_select_stock = $conectar->prepare($sql_select_stock);
        $stmt_select_stock->bindValue(1, $codigo_producto);
        $stmt_select_stock->execute();
        $stock_actual = $stmt_select_stock->fetchColumn();
        $cantidad_minima = 50;
        echo "Stock actual: $stock_actual, Cantidad mínima: $cantidad_minima";
        if ($stock_actual <= $cantidad_minima) {
            $nuevo_stock = $stock_actual + $cantidad_Compra;
            $sql_update_stock = "UPDATE productos SET cantidad_stock=? WHERE codigo_producto=?";
            $stmt_update_stock = $conectar->prepare($sql_update_stock);
            $stmt_update_stock->bindValue(1, $nuevo_stock);
            $stmt_update_stock->bindValue(2, $codigo_producto);
            $stmt_update_stock->execute();
            $fecha_compra = date("Y-m-d H:i:s");
            $sql_insert_venta = "INSERT INTO compra (fecha_compra, cantidad_compra, codigo_producto) VALUES (?, ?, ?)";
            $stmt_insert_venta = $conectar->prepare($sql_insert_venta);
            $stmt_insert_venta->bindValue(1, $fecha_compra);
            $stmt_insert_venta->bindValue(2, $cantidad_Compra);
            $stmt_insert_venta->bindValue(3, $codigo_producto);
            $stmt_insert_venta->execute();
            $conectar->commit();
            return true;
        } else {
            throw new Exception("No se pudo realizar la compra. Stock actual: $stock_actual, Cantidad mínima: $cantidad_minima");
        }
    } catch (Exception $e) {
        $conectar->rollBack();
        return false;
    }
    }
    public function post_productos($nombre, $precio, $fecha_vencimiento, $cantidad_stock){
        $conectar = parent::Conexion();
        parent::set_names();
        try {
            $conectar->beginTransaction();
            $sql_productos = "INSERT INTO productos (nombre, precio, fecha_vencimiento, cantidad_stock) VALUES (?, ?, ?, ?)";
            $stmt_productos = $conectar->prepare($sql_productos);
            $stmt_productos->execute([$nombre, $precio, $fecha_vencimiento, $cantidad_stock]);
            $conectar->commit();
            return ["status" => "success", "message" => "Registro insertado correctamente"];
        } catch (Exception $e) {
        $conectar->rollBack();
        return ["status" => "error", "message" => "Error al insertar el registro: " . $e->getMessage()];
    }
    }
        public function get_ventas() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM `ventas`";
            $sql = $conectar->prepare($sql);
                $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
        public function get_compra() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM `compra`";
            $sql = $conectar->prepare($sql);
            $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
