<?php
// controllers/RecetaController.php

require_once 'dao/RecetaDAO.php';
require_once 'dao/IngredienteDAO.php';
require_once 'dao/ComentarioDAO.php';
require_once 'dao/ValoracionDAO.php';
require_once 'models/Receta.php';
require_once 'models/Ingrediente.php';
require_once 'models/Comentario.php';
require_once 'models/Valoracion.php';


class RecetaController {
    private $recetaDAO;
    private $ingredienteDAO;
    private $comentarioDAO;
    private $valoracionDAO;

    public function __construct() {
        $this->recetaDAO = new RecetaDAO();
        $this->ingredienteDAO = new IngredienteDAO();
        $this->comentarioDAO = new ComentarioDAO();
        $this->valoracionDAO = new ValoracionDAO();
    }

    public function listarRecetas() {
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $limite = 4;
        $offset = ($pagina - 1) * $limite;

        $totalRecetas = $this->recetaDAO->contarRecetas();
        $totalPaginas = ceil($totalRecetas / $limite);

        $recetas = $this->recetaDAO->listarRecetas($offset, $limite);
        include 'views/receta/listar_recetas.php';
    }

    public function verReceta($id_receta) {
        $receta = $this->recetaDAO->obtenerRecetaPorId($id_receta);
        $ingredientes = $this->ingredienteDAO->obtenerIngredientesDeReceta($id_receta);
        $comentarios = $this->comentarioDAO->obtenerComentariosDeReceta($id_receta);
        $valoracion_media = $this->valoracionDAO->obtenerValoracionMedia($id_receta);
        include 'views/receta/ver_receta.php';
    }

    public function agregarReceta() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Manejar la carga de la imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                // Obtener el nombre original del archivo
                $nombreImagenOriginal = $_FILES['imagen']['name'];
                // Generar un nombre único usando timestamp y el nombre original
                $nombreImagen = time() . "_" . $nombreImagenOriginal;
                // Mover el archivo a la carpeta '/uploads/'
                move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/" . $nombreImagen);
            } else {
                // Si no se sube una imagen, usar la imagen por defecto
                $nombreImagen = 'default.png';
            }
    
            // Crear la receta con el nombre de la imagen
            $receta = new Receta(
                null,
                $_POST['titulo'],
                $_POST['descripcion'],
                $_POST['tiempo_elaboracion'],
                null, // fecha_publicacion se manejará en el DAO
                $_SESSION['usuario']->id_usuario,
                $_SESSION['usuario']->nombre_usuario,
                $nombreImagen,
                $_POST['tipo'],
                $_POST['dificultad']
            );
    
            $id_receta = $this->recetaDAO->agregarReceta($receta);

            // Procesar ingredientes
            $nombres_ingredientes = $_POST['ingredientes'];
            $cantidades = $_POST['cantidades'];

            foreach ($nombres_ingredientes as $index => $nombre_ingrediente) {
                $cantidad = $cantidades[$index];

                $ingrediente = $this->ingredienteDAO->obtenerIngredientePorNombre($nombre_ingrediente);
                if (!$ingrediente) {
                    $ingrediente = new Ingrediente(null, $nombre_ingrediente);
                    $id_ingrediente = $this->ingredienteDAO->agregarIngrediente($ingrediente);
                } else {
                    $id_ingrediente = $ingrediente->id_ingrediente;
                }
                $this->ingredienteDAO->agregarIngredienteAReceta($id_receta, $id_ingrediente, $cantidad);
            }

            header('Location: index.php?controller=Receta&action=verReceta&id=' . $id_receta);
        exit();
    } else {
        include 'views/receta/agregar_receta.php';
    }
}
   public function buscarRecetas() {
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $limite = 4;
        $offset = ($pagina - 1) * $limite;

        $totalRecetas = $this->recetaDAO->contarRecetas();
        $totalPaginas = ceil($totalRecetas / $limite);

      
        $criterio = $_GET['criterio'];
        $recetas = $this->recetaDAO->buscarRecetas($criterio);
        include 'views/receta/listar_recetas.php';
    }

    public function modificarReceta($id_receta) {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener la receta actual para mantener la imagen si no se cambia
            $recetaActual = $this->recetaDAO->obtenerRecetaPorId($id_receta);
    
            // Manejar la carga de la imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $nombreImagenOriginal = $_FILES['imagen']['name'];
                $nombreImagen = time() . "_" . $nombreImagenOriginal;
                move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/" . $nombreImagen);
            } else {
                // Mantener la imagen actual si no se carga una nueva
                $nombreImagen = $recetaActual->foto;
            }
    
            // Actualizar la receta con el nombre de la imagen
            $receta = new Receta(
                $id_receta,
                $_POST['titulo'],
                $_POST['descripcion'],
                $_POST['tiempo_elaboracion'],
                $recetaActual->fecha_publicacion, // Mantener la fecha de publicación
                $_SESSION['usuario']->id_usuario,
                $_SESSION['usuario']->nombre_usuario,
                $nombreImagen,
                $_POST['tipo'],
                $_POST['dificultad']
            );
    
            // Actualizar la receta en la base de datos
            $this->recetaDAO->modificarReceta($receta);
    
            // Actualizar los ingredientes
            // Primero, eliminar los ingredientes actuales de la receta
            $this->ingredienteDAO->eliminarIngredientesDeReceta($id_receta);
    
            // Luego, agregar los nuevos ingredientes
            $nombres_ingredientes = $_POST['ingredientes'];
            $cantidades = $_POST['cantidades'];
    
            foreach ($nombres_ingredientes as $index => $nombre_ingrediente) {
                $cantidad = $cantidades[$index];
    
                $ingrediente = $this->ingredienteDAO->obtenerIngredientePorNombre($nombre_ingrediente);
                if (!$ingrediente) {
                    $ingrediente = new Ingrediente(null, $nombre_ingrediente);
                    $id_ingrediente = $this->ingredienteDAO->agregarIngrediente($ingrediente);
                } else {
                    $id_ingrediente = $ingrediente->id_ingrediente;
                }
                $this->ingredienteDAO->agregarIngredienteAReceta($id_receta, $id_ingrediente, $cantidad);
            }
    
            header('Location: index.php?controller=Receta&action=verReceta&id=' . $id_receta);
            exit();
        } else {
            // Obtener los datos actuales de la receta y los ingredientes
            $receta = $this->recetaDAO->obtenerRecetaPorId($id_receta);
            $ingredientes = $this->ingredienteDAO->obtenerIngredientesDeReceta($id_receta);
            include 'views/receta/modificar_receta.php';
        }
    }
    
    public function agregarComentario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_receta = $_GET['id'];
            $contenido = $_POST['contenido'];
            $id_usuario = $_SESSION['usuario']->id_usuario;
            $id_respuesta = isset($_POST['id_respuesta']) ? $_POST['id_respuesta'] : null;
    
            $comentario = new Comentario(null, $id_receta, $id_usuario, $contenido, null, $id_respuesta);
            $this->comentarioDAO->agregarComentario($comentario);
    
            header('Location: index.php?controller=Receta&action=verReceta&id=' . $id_receta);
            exit();
        }
    }
    
    public function agregarRespuesta() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_receta = $_GET['id'];
            $contenido = $_POST['contenido'];
            $id_usuario = $_SESSION['usuario']->id_usuario;
            $id_respuesta = $_POST['id_respuesta']; // ID del comentario al que se responde
    
            // Crear un objeto Comentario con los datos de la respuesta
            $comentario = new Comentario(null, $id_receta, $id_usuario, $contenido, null, $id_respuesta);
    
            // Guardar la respuesta en la base de datos
            $this->comentarioDAO->agregarComentario($comentario);
    
            // Redirigir a la vista de la receta
            header('Location: index.php?controller=Receta&action=verReceta&id=' . $id_receta);
            exit();
        }
    }
    
    public function agregarValoracion($id_receta) {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $valor = (int)$_POST['valor'];
            $valoracion = new Valoracion(
                null,
                $id_receta,
                $_SESSION['usuario']->id_usuario,
                $valor
            );

            $this->valoracionDAO->agregarValoracion($valoracion);
            header('Location: index.php?controller=Receta&action=verReceta&id=' . $id_receta);
            exit();
        } else {
            include 'views/valoracion/agregar_valoracion.php';
        }
    }

    public function eliminarReceta($id_receta) {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
            header('Location: index.php?controller=Usuario&action=iniciarSesion');
            exit();
        }
    
        // Eliminar los ingredientes asociados
        $this->ingredienteDAO->eliminarIngredientesDeReceta($id_receta);
    
        // Eliminar la receta
        $this->recetaDAO->eliminarReceta($id_receta);
    
        header('Location: index.php?controller=Receta&action=listarRecetas');
        exit();
    }
    
}
?>