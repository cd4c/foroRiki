<?php
// models/Usuario.php
class Usuario {
    public $id_usuario;
    public $nombre_usuario;
    public $contrasena;
    public $nombre;
    public $apellidos;
    public $email;
    public $experiencia;
    public $rol;

    public function __construct($id_usuario = null, $nombre_usuario = null, $contrasena = null, $nombre = null, $apellidos = null, $email = null, $experiencia = null, $rol = null) {
        $this->id_usuario = $id_usuario;
        $this->nombre_usuario = $nombre_usuario;
        $this->contrasena = $contrasena;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->experiencia = $experiencia;
        $this->rol = $rol;
    }
}
?>