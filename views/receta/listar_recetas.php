<?php
$titulo = 'Listado de Recetas';
include 'views/header.php';
?>
<h1>Listado de Recetas</h1>
<form action="index.php" method="get" class="listado">
    <input type="hidden" name="controller" value="Receta">
    <input type="hidden" name="action" value="buscarRecetas">
    <input type="text" name="criterio" placeholder="Buscar recetas...">
    <input type="submit" value="Buscar">
</form>

<ul  class="listado">
    <?php foreach ($recetas as $receta): ?>
        <li>
        <img src="uploads/<?php echo $receta->foto; ?>" alt="Imagen de la receta" width="100">
        <br>
            <a  href="index.php?controller=Receta&action=verReceta&id=<?php echo $receta->id_receta; ?>" >
                <?php echo $receta->titulo; ?>
            </a>
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->rol == 'administrador'): ?>
                - <a href="index.php?controller=Receta&action=eliminarReceta&id=<?php echo $receta->id_receta; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta receta?');">Eliminar</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>

    <!-- Paginación -->
<div>
    <?php if ($pagina > 1): ?>
        <a href="index.php?controller=Receta&action=listarRecetas&pagina=<?php echo $pagina - 1; ?>">Anterior</a>
    <?php endif; ?>

    <span>Página <?php echo $pagina; ?> de <?php echo $totalPaginas; ?></span>

    <?php if ($pagina < $totalPaginas): ?>
        <a href="index.php?controller=Receta&action=listarRecetas&pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
    <?php endif; ?>
</div>

</ul>


<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->rol == 'administrador'): ?>
    <a href="index.php?controller=Receta&action=agregarReceta">Agregar Nueva Receta</a><br>
<?php endif; ?>

<a href="index.php">Volver al Inicio</a>
<?php include 'views/footer.php'; ?>