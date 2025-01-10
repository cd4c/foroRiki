<?php
if (!isset($_SESSION['usuario'])) {
    header('Location: /Foroplatos/permisos_denegados.php');
    exit();
}
$titulo = 'Editar Perfil';
include 'views/header.php';
?>
<h1>Editar Perfil</h1>
<form action="index.php?controller=Usuario&action=modificarPerfil" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario->nombre; ?>"><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?php echo $usuario->apellidos; ?>"><br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" value="<?php echo $usuario->email; ?>" required><br>

    <label for="experiencia">Experiencia en Cocina:</label>
    <textarea name="experiencia"><?php echo $usuario->experiencia; ?></textarea><br>

    <input type="submit" value="Guardar Cambios">
</form>
<a href="index.php?controller=Usuario&action=verPerfil&id=<?php echo $usuario->id_usuario; ?>">Volver al Perfil</a>
<?php include 'views/footer.php'; ?>