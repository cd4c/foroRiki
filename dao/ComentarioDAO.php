<?php
// dao/ComentarioDAO.php
require_once 'config/database.php';
require_once 'models/Comentario.php';

class ComentarioDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function agregarComentario($comentario) {
        $sql = "INSERT INTO comentarios (id_receta, id_usuario, contenido, fecha, id_respuesta)
                VALUES (:id_receta, :id_usuario, :contenido, NOW(), :id_respuesta)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_receta', $comentario->id_receta);
        $stmt->bindParam(':id_usuario', $comentario->id_usuario);
        $stmt->bindParam(':contenido', $comentario->contenido);
        $stmt->bindParam(':id_respuesta', $comentario->id_respuesta);
    
        $stmt->execute();
    
        // Retornar el ID del comentario insertado
        return $this->db->lastInsertId();
    }
    

    public function obtenerComentariosDeReceta($id_receta) {
        $sql = "SELECT comentarios.*, usuarios.nombre_usuario AS nombre_usuario FROM comentarios 
                JOIN usuarios ON comentarios.id_usuario = usuarios.id_usuario 
                WHERE comentarios.id_receta = :id_receta 
                ORDER BY comentarios.fecha ASC";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_receta', $id_receta, PDO::PARAM_INT);
        $stmt->execute();
    
        $comentariosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $comentarios = [];
        foreach ($comentariosData as $comentarioData) {
            $comentarios[] = new Comentario(
                $comentarioData['id_comentario'],
                $comentarioData['id_receta'],
                $comentarioData['id_usuario'],
                $comentarioData['contenido'],
                $comentarioData['fecha'],
                $comentarioData['id_respuesta'],
                $comentarioData['nombre_usuario']
            );
        }
    
        return $comentarios;
    }
    
}
?>