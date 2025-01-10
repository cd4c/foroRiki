<?php
$titulo = 'Darse de Baja';
if (!isset($_SESSION['usuario'])) {
    header('Location: permisos_denegados.php');
    exit();
}
include 'views/header.php';
?>
<h1>Darse de Baja</h1>
<p>Para confirmar que deseas darte de baja, introduce tu contraseña:</p>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="index.php?controller=Usuario&action=darseDeBaja" method="post">
    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required><br>

    <input type="submit" value="Darse de Baja">
</form>
<a href="index.php?controller=Usuario&action=verPerfil&id=<?php echo $_SESSION['usuario']->id_usuario; ?>">Volver al Perfil</a>
<?php include 'views/footer.php'; ?>