<?php
class Comentario {
    public $id_comentario;
    public $id_receta;
    public $id_usuario;
    public $contenido;
    public $fecha;
    public $id_respuesta;
    public $nombre_usuario;

    public function __construct($id_comentario = null, $id_receta = null, $id_usuario = null, $contenido = null, $fecha = null, $id_respuesta = null, $nombre_usuario = null) {
        $this->id_comentario = $id_comentario;
        $this->id_receta = $id_receta;
        $this->id_usuario = $id_usuario;
        $this->contenido = $contenido;
        $this->fecha = $fecha;
        $this->id_respuesta = $id_respuesta;
        $this->nombre_usuario = $nombre_usuario;
    }
}
?>
