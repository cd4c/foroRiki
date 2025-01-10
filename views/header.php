<!-- views/header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($titulo) ? $titulo : 'Foro Platos'; ?></title>
    <!-- Enlace al archivo CSS actualizado -->
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <header>

        <!-- Menú de navegación -->
        <nav>
            <a href="index.php">Inicio</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="index.php?controller=Usuario&action=verPerfil&id=<?php echo $_SESSION['usuario']->id_usuario; ?>">Mi Perfil</a>
                <?php if ($_SESSION['usuario']->rol == 'administrador'): ?>
                    <a href="index.php?controller=Administrador&action=listarUsuarios">Administrar Usuarios</a>
                    <a href="index.php?controller=Receta&action=agregarReceta">Agregar Receta</a>
                <?php endif; ?>
                <a href="index.php?controller=Usuario&action=cerrarSesion">Cerrar Sesión</a>
            <?php else: ?>
                <a href="index.php?controller=Usuario&action=iniciarSesion">Iniciar Sesión</a>
                <a href="index.php?controller=Usuario&action=registrar">Registrarse</a>
            <?php endif; ?>
        </nav>
    </header>
    <main >
