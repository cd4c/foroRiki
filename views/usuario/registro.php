<?php
$titulo = 'Registro de Usuario';
include 'views/header.php';
?>
<h1>Registro de Usuario</h1>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="index.php?controller=Usuario&action=registrar" method="post">
    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" name="nombre_usuario" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required minlength="6"><br>

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre"><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos"><br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required><br>

    <label for="experiencia">Experiencia en Cocina:</label>
    <textarea name="experiencia"></textarea><br>

    <input type="submit" value="Registrarse">
</form>
<p>¿Ya tienes una cuenta? <a href="index.php?controller=Usuario&action=iniciarSesion">Inicia sesión aquí</a></p>
<?php include 'views/footer.php'; ?>