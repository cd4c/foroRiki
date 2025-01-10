<?php
// Incluir la definición de la clase Database
require_once 'config/database.php';

// Autoloader para cargar clases automáticamente desde múltiples directorios
spl_autoload_register(function ($class_name) {
    $directories = ['models/', 'controllers/', 'config/'];
    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Iniciar la sesión
session_start();

// Función para asegurar que el usuario administrador existe
function ensureAdminUserExists() {
    // Conectar a la base de datos
    $db = Database::connect();

    // Verificar si el usuario administrador existe
    $sql = "SELECT COUNT(*) as count FROM usuarios WHERE nombre_usuario = :nombre_usuario";
    $stmt = $db->prepare($sql);
    $admin_username = 'administrador';
    $stmt->bindParam(':nombre_usuario', $admin_username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] == 0) {
        // El usuario administrador no existe, lo creamos
        $sql = "INSERT INTO usuarios (nombre_usuario, contrasena, nombre, apellidos, email, experiencia, rol) 
                VALUES (:nombre_usuario, :contrasena, :nombre, :apellidos, :email, :experiencia, :rol)";
        $stmt = $db->prepare($sql);

        // Hashear la contraseña por seguridad
        $password_plain = 'PHPmola';
        $password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

        // Valores para los campos adicionales
        $nombre = 'Admin';
        $apellidos = 'Istrador';
        $email = 'admin@example.com'; // Asegúrate de que este email es único en tu base de datos
        $experiencia = 'Usuario con privilegios de administrador';
        $rol = 'administrador';

        // Enlazar los parámetros
        $stmt->bindParam(':nombre_usuario', $admin_username);
        $stmt->bindParam(':contrasena', $password_hashed);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':experiencia', $experiencia);
        $stmt->bindParam(':rol', $rol);

        // Ejecutar la consulta
        $stmt->execute();
    }

    // Cerrar la conexión a la base de datos
    $db = null;
}

// Llamar a la función para asegurar que el usuario administrador existe
ensureAdminUserExists();
?>