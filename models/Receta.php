<?php
class Receta {
    public $id_receta;
    public $titulo;
    public $descripcion;
    public $tiempo_elaboracion;
    public $fecha_publicacion;
    public $id_admin; // Agregamos esta propiedad
    public $admin_nombre;
    public $foto;
    public $tipo;
    public $dificultad;

    public function __construct($id_receta, $titulo, $descripcion, $tiempo_elaboracion, $fecha_publicacion, $id_admin, $admin_nombre, $foto, $tipo,  $dificultad) {
        $this->id_receta = $id_receta;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->tiempo_elaboracion = $tiempo_elaboracion;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->id_admin = $id_admin;
        $this->admin_nombre = $admin_nombre;
        $this->foto = $foto;
        $this->tipo = $tipo;
        $this->dificultad = $dificultad;
    }
}

?>
