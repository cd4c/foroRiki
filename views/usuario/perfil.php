<?php
$titulo = 'Perfil de ' . $usuario->nombre_usuario;
if (!isset($_SESSION['usuario'])) {
    header('Location: permisos_denegados.php');
    exit();
}
include 'views/header.php';
?>
<h1>Perfil de <?php echo $usuario->nombre_usuario; ?></h1>
<p><strong>Nombre:</strong> <?php echo $usuario->nombre; ?></p>
<p><strong>Apellidos:</strong> <?php echo $usuario->apellidos; ?></p>
<p><strong>Email:</strong> <?php echo $usuario->email; ?></p>
<p><strong>Experiencia:</strong> <?php echo nl2br($usuario->experiencia); ?></p>

<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->id_usuario == $usuario->id_usuario): ?>
    <a href="index.php?controller=Usuario&action=modificarPerfil">Editar Perfil</a><br>
    <a href="index.php?controller=Usuario&action=cambiarContrasena">Cambiar Contraseña</a><br>
    <a href="index.php?controller=Usuario&action=darseDeBaja">Darse de Baja</a><br>
<?php endif; ?>

<a href="index.php">Volver al Inicio</a>
<?php include 'views/footer.php'; ?>