<?php
// models/Ingrediente.php
class Ingrediente {
    public $id_ingrediente;
    public $nombre;

    public function __construct($id_ingrediente, $nombre) {
        $this->id_ingrediente = $id_ingrediente;
        $this->nombre = $nombre;
    }
}
?>