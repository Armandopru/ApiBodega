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
    public function delete_bodega($codigo_producto) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM productos WHERE codigo_producto=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $codigo_producto);
        $sql->execute();
        return true;
    }
}
?>
