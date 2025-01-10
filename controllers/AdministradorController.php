<?php
// controllers/AdministradorController.php

require_once 'dao/UsuarioDAO.php';
require_once 'models/Usuario.php';

class AdministradorController {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function listarUsuarios() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
            header('Location: index.php');
            exit();
        }

        $usuarios = $this->usuarioDAO->listarUsuarios();
        include 'views/administrador/listar_usuarios.php';
    }

    public function eliminarUsuario($id_usuario) {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
            header('Location: index.php');
            exit();
        }

        $this->usuarioDAO->eliminarUsuario($id_usuario);
        header('Location: index.php?controller=Administrador&action=listarUsuarios');
        exit();
    }

    public function hacerAdministrador($id_usuario) {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
            header('Location: index.php');
            exit();
        }

        $this->usuarioDAO->hacerAdministrador($id_usuario);
        header('Location: index.php?controller=Administrador&action=listarUsuarios');
        exit();
    }
}
?>
