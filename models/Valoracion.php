<?php
// models/Valoracion.php
class Valoracion {
    public $id_valoracion;
    public $id_receta;
    public $id_usuario;
    public $valor;

    public function __construct($id_valoracion, $id_receta, $id_usuario, $valor) {
        $this->id_valoracion = $id_valoracion;
        $this->id_receta = $id_receta;
        $this->id_usuario = $id_usuario;
        $this->valor = $valor;
    }
}
?>