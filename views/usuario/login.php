<?php
$titulo = 'Iniciar Sesión';
include 'views/header.php';
?>
<h1>Iniciar Sesión</h1>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="index.php?controller=Usuario&action=iniciarSesion" method="post">
    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" name="nombre_usuario" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required><br>

    <input type="submit" value="Iniciar Sesión">
</form>
<p>¿No tienes una cuenta? <a href="index.php?controller=Usuario&action=registrar">Regístrate aquí</a></p>
<?php include 'views/footer.php'; ?>