<?php
// dao/RecetaDAO.php
require_once 'config/database.php';
require_once 'models/Receta.php';

class RecetaDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function agregarReceta($receta) {
        $sql = "INSERT INTO recetas (titulo, descripcion, tiempo_elaboracion, fecha_publicacion, id_admin, foto, tipo, dificultad)
                VALUES (:titulo, :descripcion, :tiempo_elaboracion, now(), :id_admin, :foto, :tipo, :dificultad)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $receta->titulo);
        $stmt->bindParam(':descripcion', $receta->descripcion);
        $stmt->bindParam(':tiempo_elaboracion', $receta->tiempo_elaboracion);
        $stmt->bindParam(':id_admin', $receta->id_admin);
        $stmt->bindParam(':foto', $receta->foto);
        $stmt->bindParam(':tipo', $receta->tipo);
        $stmt->bindParam(':dificultad', $receta->dificultad);
        $stmt->execute();
    
        // Retornar el ID de la receta insertada
        return $this->db->lastInsertId();
    }
    
    public function obtenerRecetaPorId($id_receta) {
        $sql = "SELECT recetas.*, usuarios.nombre_usuario AS admin_nombre FROM recetas 
                JOIN usuarios ON recetas.id_admin = usuarios.id_usuario WHERE id_receta = :id_receta";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_receta', $id_receta, PDO::PARAM_INT);
        $stmt->execute();
        $recetaData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($recetaData) {
            return new Receta(
                $recetaData['id_receta'],
                $recetaData['titulo'],
                $recetaData['descripcion'],
                $recetaData['tiempo_elaboracion'],
                $recetaData['fecha_publicacion'],
                $recetaData['id_admin'],
                $recetaData['admin_nombre'],
                $recetaData['foto'],
                $recetaData['tipo'],
                $recetaData['dificultad']
            );
        } else {
            return null;
        }
    }

    public function listarRecetas($offset = 0, $limite = 10) {
        $sql = "SELECT recetas.*, usuarios.nombre_usuario AS admin_nombre FROM recetas 
                JOIN usuarios ON recetas.id_admin = usuarios.id_usuario 
                LIMIT $offset, $limite";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $recetas = [];
        while ($recetaData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $recetas[] = new Receta(
                $recetaData['id_receta'],
                $recetaData['titulo'],
                $recetaData['descripcion'],
                $recetaData['tiempo_elaboracion'],
                $recetaData['fecha_publicacion'],
                $recetaData['id_admin'],
                $recetaData['admin_nombre'],
                $recetaData['foto'],
                $recetaData['tipo'],
                $recetaData['dificultad']
            );
        }
        return $recetas;
    }

    public function modificarReceta($receta) {
        $sql = "UPDATE recetas SET titulo = :titulo, descripcion = :descripcion, tiempo_elaboracion = :tiempo_elaboracion, foto = :foto, tipo = :tipo, dificultad = :dificultad WHERE id_receta = :id_receta";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $receta->titulo);
        $stmt->bindParam(':descripcion', $receta->descripcion);
        $stmt->bindParam(':tiempo_elaboracion', $receta->tiempo_elaboracion);
        $stmt->bindParam(':foto', $receta->foto);
        $stmt->bindParam(':tipo', $receta->tipo);
        $stmt->bindParam(':dificultad', $receta->dificultad);
        $stmt->bindParam(':id_receta', $receta->id_receta);
        $stmt->execute();
    }
    
    public function eliminarReceta($id_receta) {
        $sql = "DELETE FROM recetas WHERE id_receta = :id_receta";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_receta', $id_receta);
        $stmt->execute();
    }

    public function buscarRecetas($criterio) {
        $sql = "SELECT recetas.*, usuarios.nombre_usuario AS admin_nombre FROM recetas 
                JOIN usuarios ON recetas.id_admin = usuarios.id_usuario 
                WHERE recetas.titulo LIKE :criterio";
        $stmt = $this->db->prepare($sql);
        $criterio = "%$criterio%";
        $stmt->bindParam(':criterio', $criterio, PDO::PARAM_STR);
        $stmt->execute();
        $recetas = [];
        while ($recetaData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $recetas[] = new Receta(
                $recetaData['id_receta'],
                $recetaData['titulo'],
                $recetaData['descripcion'],
                $recetaData['tiempo_elaboracion'],
                $recetaData['fecha_publicacion'],
                $recetaData['id_admin'],
                $recetaData['admin_nombre'],
                $recetaData['foto'],
                $recetaData['tipo'],
                $recetaData['dificultad']
            );
        }
        return $recetas;
    }

    public function contarRecetas() {
        $sql = "SELECT COUNT(*) as total FROM recetas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['total'];
    }

    public function eliminarIngredientesDeReceta($id_receta) {
        $sql = "DELETE FROM receta_ingredientes WHERE id_receta = :id_receta";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_receta', $id_receta);
        $stmt->execute();
    }
}
?>
