<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol != 'administrador') {
    header('Location: /Foroplatos/permisos_denegados.php');
    exit();
}
$titulo = 'Agregar Receta';
include 'views/header.php';
?>
<h1>Agregar Nueva Receta</h1>
    
<form action="index.php?controller=Receta&action=agregarReceta" method="post" enctype="multipart/form-data">
    
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea><br>

    <label for="tiempo_elaboracion">Tiempo de Elaboración (HH:MM:SS):</label>
    <input type="time" name="tiempo_elaboracion" required><br>

    <label for="tipo">Tipo de Receta:</label>
    <select name="tipo" required>
        <option value="tradicional">Tradicional</option>
        <option value="slow_food">Slow Food</option>
        <option value="freidora_aire">Freidora sin Aceite</option>
    </select><br>

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" accept="image/*"><br>


    <h3>Ingredientes:</h3>
    <div id="ingredientes">
        <div>
            <label>Ingrediente:</label>
            <input type="text" name="ingredientes[]" required>
            <label>Cantidad:</label>
            <input type="text" name="cantidades[]" required><br>
        </div>
    </div>
    <button type="button" onclick="agregarIngrediente()">Agregar Otro Ingrediente</button><br>


    <label for="dificultad">Dificultad:</label>
    <select name="dificultad" id="dificultad" required>
        <option value="Fácil">Fácil</option>
        <option value="Media">Media</option>
        <option value="Difícil">Difícil</option>
    </select>
    <!-- Botón de envío -->
    <input type="submit" value="Agregar Receta">
</form>

<a href="index.php?controller=Receta&action=listarRecetas">Volver al Listado de Recetas</a>

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