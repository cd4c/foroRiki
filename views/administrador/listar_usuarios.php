<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
    header('Location: /Foroplatos/permisos_denegados.php');
    exit();
}
$titulo = 'Listado de Usuarios';
include 'views/header.php';
?>
<h1>Listado de Usuarios</h1>
<table border="1">
    <tr>
        <th>Nombre de Usuario</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario->nombre_usuario; ?></td>
            <td><?php echo $usuario->email; ?></td>
            <td><?php echo $usuario->rol; ?></td>
            <td>
                <?php if ($usuario->rol != 'administrador'): ?>
                    <a href="index.php?controller=Administrador&action=hacerAdministrador&id=<?php echo $usuario->id_usuario; ?>">Hacer Administrador</a>
                    <a href="index.php?controller=Administrador&action=eliminarUsuario&id=<?php echo $usuario->id_usuario; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar a este usuario?');">Eliminar Usuario</a>
                <?php else: ?>
                    Administrador
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php">Volver al Inicio</a>
<?php include 'views/footer.php'; ?>