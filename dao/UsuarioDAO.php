<?php
// dao/UsuarioDAO.php

require_once 'config/database.php';
require_once 'models/Usuario.php';

class UsuarioDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function registrar($usuario) {
        // Hashear la contraseña antes de almacenarla
        $contrasenaHasheada = password_hash($usuario->contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre_usuario, contrasena, nombre, apellidos, email, experiencia, rol)
                VALUES (:nombre_usuario, :contrasena, :nombre, :apellidos, :email, :experiencia, :rol)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $usuario->nombre_usuario);
        $stmt->bindParam(':contrasena', $contrasenaHasheada);
        $stmt->bindParam(':nombre', $usuario->nombre);
        $stmt->bindParam(':apellidos', $usuario->apellidos);
        $stmt->bindParam(':email', $usuario->email);
        $stmt->bindParam(':experiencia', $usuario->experiencia);
        $stmt->bindParam(':rol', $usuario->rol);
        $stmt->execute();
    }

    public function iniciarSesion($nombre_usuario, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData && password_verify($contrasena, $usuarioData['contrasena'])) {
            return new Usuario(
                $usuarioData['id_usuario'],
                $usuarioData['nombre_usuario'],
                $usuarioData['contrasena'],
                $usuarioData['nombre'],
                $usuarioData['apellidos'],
                $usuarioData['email'],
                $usuarioData['experiencia'],
                $usuarioData['rol']
            );
        } else {
            return null;
        }
    }

    public function obtenerUsuarioPorId($id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData) {
            return new Usuario(
                $usuarioData['id_usuario'],
                $usuarioData['nombre_usuario'],
                $usuarioData['contrasena'],
                $usuarioData['nombre'],
                $usuarioData['apellidos'],
                $usuarioData['email'],
                $usuarioData['experiencia'],
                $usuarioData['rol']
            );
        } else {
            return null;
        }
    }

    public function modificarPerfil($usuario) {
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, experiencia = :experiencia
                WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $usuario->nombre);
        $stmt->bindParam(':apellidos', $usuario->apellidos);
        $stmt->bindParam(':email', $usuario->email);
        $stmt->bindParam(':experiencia', $usuario->experiencia);
        $stmt->bindParam(':id_usuario', $usuario->id_usuario);
        $stmt->execute();
    }

    public function cambiarContrasena($id_usuario, $nueva_contrasena) {
        // Hashear la nueva contraseña
        $contrasenaHasheada = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET contrasena = :contrasena WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':contrasena', $contrasenaHasheada);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
    }

    public function darseDeBaja($id_usuario) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
    }

    public function listarUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->db->query($sql);
        $usuarios = [];
        while ($usuarioData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario(
                $usuarioData['id_usuario'],
                $usuarioData['nombre_usuario'],
                null, // No necesitamos la contraseña aquí
                $usuarioData['nombre'],
                $usuarioData['apellidos'],
                $usuarioData['email'],
                $usuarioData['experiencia'],
                $usuarioData['rol']
            );
        }
        return $usuarios;
    }

    public function eliminarUsuario($id_usuario) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
    }

    public function hacerAdministrador($id_usuario) {
        $sql = "UPDATE usuarios SET rol = 'administrador' WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
    }
}
?>