<?php

if (!isset($_SESSION['usuario'])) {
    header('Location: ../permisos_denegados.php');
    exit();
}
$titulo = 'Cambiar Contraseña';
include 'views/header.php';
?>
<h1>Cambiar Contraseña</h1>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if (isset($mensaje)) echo "<p style='color:green;'>$mensaje</p>"; ?>
<form action="index.php?controller=Usuario&action=cambiarContrasena" method="post">
    <label for="contrasena_actual">Contraseña Actual:</label>
    <input type="password" name="contrasena_actual" required><br>

    <label for="nueva_contrasena">Nueva Contraseña:</label>
    <input type="password" name="nueva_contrasena" required minlength="6"><br>

    <input type="submit" value="Cambiar Contraseña">
</form>
<a href="index.php?controller=Usuario&action=verPerfil&id=<?php echo $_SESSION['usuario']->id_usuario; ?>">Volver al Perfil</a>
<?php include 'views/footer.php'; ?>