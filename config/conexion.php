<?php
class Conectar {
    protected $dbh;

    protected function Conexion() {
        try {
            $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=inventario","root","");
            return $conectar;
        } catch (PDOException $e) {
            echo "¡Error DB!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
//holala
    public function set_names() {
        return $this->dbh->query("SET NAMES 'utf8'");
    }
}
?>