<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
    header('Location: /Foroplatos/permisos_denegados.php');
    exit();
}
$titulo = 'Modificar Recetas';
include 'views/header.php';
?>
<h1>Modificar Receta</h1>
<form action="index.php?controller=Receta&action=modificarReceta&id=<?php echo $receta->id_receta; ?>" method="post" enctype="multipart/form-data">
 
<label for="titulo">Título:</label>
    <input type="text" name="titulo" value="<?php echo $receta->titulo; ?>" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required><?php echo $receta->descripcion; ?></textarea><br>

    <label for="tiempo_elaboracion">Tiempo de Elaboración (HH:MM:SS):</label>
    <input type="time" name="tiempo_elaboracion" value="<?php echo $receta->tiempo_elaboracion; ?>" required><br>

    <label for="tipo">Tipo de Receta:</label>
    <select name="tipo" required>
        <option value="tradicional" <?php if ($receta->tipo == 'tradicional') echo 'selected'; ?>>Tradicional</option>
        <option value="slow_food" <?php if ($receta->tipo == 'slow_food') echo 'selected'; ?>>Slow Food</option>
        <option value="freidora_aire" <?php if ($receta->tipo == 'freidora_aire') echo 'selected'; ?>>Freidora sin Aceite</option>
    </select><br>

    <p>Imagen Actual:</p>
    <img src="uploads/<?php echo $receta->foto; ?>" alt="Imagen de la receta" width="200"><br>

    <label for="imagen">Cambiar Imagen:</label>
    <input type="file" name="imagen" accept="image/*"><br>
    <small>Si no seleccionas una imagen, se mantendrá la actual.</small><br>

    <h3>Ingredientes:</h3>
    <div id="ingredientes">
        <?php foreach ($ingredientes as $ingrediente): ?>
            <div>
                <label>Ingrediente:</label>
                <input type="text" name="ingredientes[]" value="<?php echo $ingrediente['nombre']; ?>" required>
                <label>Cantidad:</label>
                <input type="text" name="cantidades[]" value="<?php echo $ingrediente['cantidad']; ?>" required><br>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" onclick="agregarIngrediente()">Agregar Otro Ingrediente</button><br>

    <label for="dificultad">Dificultad:</label>
    <select name="dificultad" id="dificultad" required>
        <option value="Fácil" <?php if ($receta->dificultad == 'Fácil') echo 'selected'; ?>>Fácil</option>
        <option value="Media" <?php if ($receta->dificultad == 'Media') echo 'selected'; ?>>Media</option>
        <option value="Difícil" <?php if ($receta->dificultad == 'Difícil') echo 'selected'; ?>>Difícil</option>
    </select>
    <!-- Botón de envío -->
    <input type="submit" value="Modificar Receta">
</form>
<a href="index.php?controller=Receta&action=verReceta&id=<?php echo $receta->id_receta; ?>">Volver a la Receta</a>

<script>
    function agregarIngrediente() {
        var container = document.getElementById('ingredientes');
        var div = document.createElement('div');
        div.innerHTML = `
            <label>Ingrediente:</label>
            <input type="text" name="ingredientes[]" required>
            <label>Cantidad:</label>
            <input type="text" name="cantidades[]" required><br>
        `;
        container.appendChild(div);
    }
</script>
<?php include 'views/footer.php'; ?>
