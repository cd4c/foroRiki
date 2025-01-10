<?php
// dao/IngredienteDAO.php
require_once 'config/database.php';
require_once 'models/Ingrediente.php';

class IngredienteDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function obtenerIngredientePorNombre($nombre) {
        $sql = "SELECT * FROM ingredientes WHERE nombre = '$nombre'";
        $result = $this->db->query($sql);
        $ingredienteData = $result->fetch(PDO::FETCH_ASSOC);

        if ($ingredienteData) {
            return new Ingrediente(
                $ingredienteData['id_ingrediente'],
                $ingredienteData['nombre']
            );
        } else {
            return null;
        }
    }

    public function agregarIngrediente($ingrediente) {
        $sql = "INSERT INTO ingredientes (nombre) VALUES ('{$ingrediente->nombre}')";
        $this->db->query($sql);
        return $this->db->lastInsertId();
    }

    public function obtenerTodosIngredientes() {
        $sql = "SELECT * FROM ingredientes";
        $result = $this->db->query($sql);
        $ingredientes = [];
        while ($ingredienteData = $result->fetch(PDO::FETCH_ASSOC)) {
            $ingredientes[] = new Ingrediente(
                $ingredienteData['id_ingrediente'],
                $ingredienteData['nombre']
            );
        }
        return $ingredientes;
    }

    public function eliminarIngredientesDeReceta($id_receta) {
        $sql = "DELETE FROM recetas_ingredientes WHERE id_receta = :id_receta";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_receta', $id_receta, PDO::PARAM_INT);
        $stmt->execute();
    }
    

    public function agregarIngredienteAReceta($id_receta, $id_ingrediente, $cantidad) {
        $sql = "INSERT INTO recetas_ingredientes (id_receta, id_ingrediente, cantidad)
                VALUES ($id_receta, $id_ingrediente, '$cantidad')";
        $this->db->query($sql);
    }

    public function obtenerIngredientesDeReceta($id_receta) {
        $sql = "SELECT ri.cantidad, i.nombre FROM recetas_ingredientes ri
                JOIN ingredientes i ON ri.id_ingrediente = i.id_ingrediente
                WHERE ri.id_receta = $id_receta";
        $result = $this->db->query($sql);
        $ingredientes = [];
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            $ingredientes[] = $data;
        }
        return $ingredientes;
    }
}
?>