<?php
$titulo = $receta->titulo;
include 'views/header.php';
?>
<h1><?php echo $receta->titulo; ?></h1>
<p><strong>Autor:</strong> 
    <?php 
    $perfilUrl = 'index.php?controller=Usuario&action=verPerfil&id=' . $receta->id_admin;
    echo '<a href="' . $perfilUrl . '">' . htmlspecialchars($receta->admin_nombre) . '</a>'; 
    ?>
</p>

<p><strong>Fecha de publicación:</strong> <?php echo $receta->fecha_publicacion; ?></p>
<p><strong>Tipo de receta:</strong> <?php echo $receta->tipo; ?></p>
<p><strong>Tiempo de elaboración:</strong> <?php echo $receta->tiempo_elaboracion; ?></p>
<p><strong>Dificultad:</strong> <?php echo htmlspecialchars($receta->dificultad); ?></p>
<img src="uploads/<?php echo $receta->foto; ?>" alt="Imagen de la receta" width="300"><br>

<h2>Ingredientes:</h2>
<ul>
    <?php foreach ($ingredientes as $ingrediente): ?>
        <li><?php echo $ingrediente['cantidad'] . ' de ' . $ingrediente['nombre']; ?></li>
    <?php endforeach; ?>
</ul>

<h2>Descripción:</h2>
<p><?php echo nl2br($receta->descripcion); ?></p>
<div class="fila">
<h2>Valoración Media:</h2>
<p><?php echo $valoracion_media ? number_format($valoracion_media, 2) : 'Sin valoraciones'; ?> / 5</p>
</div>
<div  class="fila">
<?php if (isset($_SESSION['usuario'])): ?>
    <h2>Valorar esta Receta:</h2>
    <form action="index.php?controller=Receta&action=agregarValoracion&id=<?php echo $receta->id_receta; ?>" method="post">
        <label for="valor">Puntuación (1-5):</label>
        <input type="number" name="valor" min="1" max="5" required>
        <input type="submit" value="Enviar Valoración">
    </form>
<?php else: ?>
    <p>Debes <a href="index.php?controller=Usuario&action=iniciarSesion">iniciar sesión</a> para valorar.</p>
<?php endif; ?>
</div>

<!-- En la sección de comentarios -->
<h2>Comentarios:</h2>
<?php
if (!empty($comentarios)) {
    mostrarComentarios($comentarios, $receta);
} else {
    echo "<p>No hay comentarios aún. ¡Sé el primero en comentar!</p>";
}
// funcion que muestra los usuarios
function mostrarComentarios($comentarios, $receta, $id_respuesta = null, $nivel = 0) {
    foreach ($comentarios as $comentario) {
        if ($comentario->id_respuesta == $id_respuesta) {
            echo '<div style="margin-left: ' . ($nivel * 20) . 'px; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">';
            
            // Enlace al perfil del usuario
            $perfilUrl = 'index.php?controller=Usuario&action=verPerfil&id=' . $comentario->id_usuario;
            $nombreUsuarioLink = '<a href="' . $perfilUrl . '">' . htmlspecialchars($comentario->nombre_usuario) . '</a>';

            if ($nivel > 0) {
                echo '<p><strong>' . $nombreUsuarioLink . ' ha respondido:</strong> ' . nl2br(htmlspecialchars($comentario->contenido)) . '</p>';
            } else {
                echo '<p><strong>' . $nombreUsuarioLink . ':</strong> ' . nl2br(htmlspecialchars($comentario->contenido)) . '</p>';
            }
            
            echo '<p><em>Fecha: ' . $comentario->fecha . '</em></p>';

            // Enlace para mostrar el formulario de respuesta
            if (isset($_SESSION['usuario'])) {
                $formId = 'form-respuesta-' . $comentario->id_comentario;
                $linkId = 'link-respuesta-' . $comentario->id_comentario;

                echo '<a href="#" id="' . $linkId . '" onclick="mostrarFormularioRespuesta(' . $comentario->id_comentario . '); return false;">Responder</a>';

                echo '<div id="' . $formId . '" style="display: none; margin-top: 10px;">';
                echo '<form action="index.php?controller=Receta&action=agregarRespuesta&id=' . $receta->id_receta . '" method="post">';
                echo '<input type="hidden" name="id_respuesta" value="' . $comentario->id_comentario . '">';
                echo '<textarea name="contenido" required></textarea><br>';
                echo '<input type="submit" value="Enviar respuesta">';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<p>Debes <a href="index.php?controller=Usuario&action=iniciarSesion">iniciar sesión</a> para responder.</p>';
            }

            echo '</div>';

            mostrarComentarios($comentarios, $receta, $comentario->id_comentario, $nivel + 1);
        }
    }
}

?>

<!-- Formulario para agregar un nuevo comentario -->
<?php if (isset($_SESSION['usuario'])): ?>
    <h3>Agregar Comentario:</h3>
    <form action="index.php?controller=Receta&action=agregarComentario&id=<?php echo $receta->id_receta; ?>" method="post">
        <textarea name="contenido" required></textarea><br>
        <input type="submit" value="Enviar Comentario">
    </form>
<?php else: ?>
    <p>Debes <a href="index.php?controller=Usuario&action=iniciarSesion">iniciar sesión</a> para comentar.</p>
<?php endif; ?>

<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->rol == 'administrador'): ?>
    <a href="index.php?controller=Receta&action=modificarReceta&id=<?php echo $receta->id_receta; ?>">Modificar Receta</a><br>
    <a href="index.php?controller=Receta&action=eliminarReceta&id=<?php echo $receta->id_receta; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta receta?');">Eliminar Receta</a><br>
<?php endif; ?>

<a href="index.php?controller=Receta&action=listarRecetas">Volver al Listado de Recetas</a>
<?php include 'views/footer.php'; ?>
<script>
function mostrarFormularioRespuesta(idComentario) {
    var formulario = document.getElementById('form-respuesta-' + idComentario);
    if (formulario.style.display === 'none' || formulario.style.display === '') {
        formulario.style.display = 'block';
    } else {
        formulario.style.display = 'none';
    }
}
</script>
