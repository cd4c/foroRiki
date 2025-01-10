<?php
// controllers/UsuarioController.php

require_once 'dao/UsuarioDAO.php';
require_once 'models/Usuario.php';

class UsuarioController {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $usuario = new Usuario(
                null,
                $_POST['nombre_usuario'],
                $_POST['contrasena'],
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['experiencia'],
                'usuario_registrado'
            );

            $this->usuarioDAO->registrar($usuario);
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        } else {
            include 'views/usuario/registro.php';
        }
    }

    public function iniciarSesion() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];

            $usuario = $this->usuarioDAO->iniciarSesion($nombre_usuario, $contrasena);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php');
                exit();
            } else {
                $error = 'Nombre de usuario o contraseña incorrectos';
                include 'views/usuario/login.php';
            }
        } else {
            include 'views/usuario/login.php';
        }
    }

    public function verPerfil($id_usuario) {
        $usuario = $this->usuarioDAO->obtenerUsuarioPorId($id_usuario);
        include 'views/usuario/perfil.php';
    }

    public function modificarPerfil() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }

        $id_usuario = $_SESSION['usuario']->id_usuario;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario(
                $id_usuario,
                $_SESSION['usuario']->nombre_usuario,
                $_SESSION['usuario']->contrasena,
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['experiencia'],
                $_SESSION['usuario']->rol
            );

            $this->usuarioDAO->modificarPerfil($usuario);
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php?controller=Usuario&action=verPerfil&id=' . $id_usuario);
            exit();
        } else {
            $usuario = $this->usuarioDAO->obtenerUsuarioPorId($id_usuario);
            include 'views/usuario/editar_perfil.php';
        }
    }

    public function cambiarContrasena() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }

        $id_usuario = $_SESSION['usuario']->id_usuario;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $contrasena_actual = $_POST['contrasena_actual'];
            $nueva_contrasena = $_POST['nueva_contrasena'];

            // Obtener el usuario actual desde la base de datos
            $usuarioActual = $this->usuarioDAO->obtenerUsuarioPorId($id_usuario);

            if ($usuarioActual && password_verify($contrasena_actual, $usuarioActual->contrasena)) {
                $this->usuarioDAO->cambiarContrasena($id_usuario, $nueva_contrasena);
                // Actualizar la contraseña en la sesión
                $usuarioActual->contrasena = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
                $_SESSION['usuario'] = $usuarioActual;
                $mensaje = 'Contraseña cambiada exitosamente.';
                include 'views/usuario/cambiar_contrasena.php';
            } else {
                $error = 'La contraseña actual es incorrecta.';
                include 'views/usuario/cambiar_contrasena.php';
            }
        } else {
            include 'views/usuario/cambiar_contrasena.php';
        }
    }

    public function darseDeBaja() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }

        $id_usuario = $_SESSION['usuario']->id_usuario;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $contrasena = $_POST['contrasena'];

            // Obtener el usuario actual desde la base de datos
            $usuarioActual = $this->usuarioDAO->obtenerUsuarioPorId($id_usuario);

            if ($usuarioActual && password_verify($contrasena, $usuarioActual->contrasena)) {
                $this->usuarioDAO->darseDeBaja($id_usuario);
                session_destroy();
                header('Location: index.php');
                exit();
            } else {
                $error = 'La contraseña es incorrecta.';
                include 'views/usuario/darse_de_baja.php';
            }
        } else {
            include 'views/usuario/darse_de_baja.php';
        }
    }

    public function cerrarSesion() {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>