<?php
// dao/ValoracionDAO.php
require_once 'config/database.php';
require_once 'models/Valoracion.php';

class ValoracionDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function agregarValoracion($valoracion) {
        $sql = "INSERT INTO valoraciones (id_receta, id_usuario, valor)
                VALUES ({$valoracion->id_receta}, {$valoracion->id_usuario}, {$valoracion->valor})
                ON DUPLICATE KEY UPDATE valor = VALUES(valor)";
        $this->db->query($sql);
    }

    public function obtenerValoracionMedia($id_receta) {
        $sql = "SELECT AVG(valor) as media FROM valoraciones WHERE id_receta = $id_receta";
        $result = $this->db->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data['media'];
    }
}
?>