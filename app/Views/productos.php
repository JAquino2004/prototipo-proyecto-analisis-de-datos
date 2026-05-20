<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Productos</title>

  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="products-container">

    <!-- 🔙 BOTÓN VOLVER -->
    <a href="<?= base_url('vendedor') ?>">
      <button class="btn-back">⬅ Volver al inicio</button>
    </a>

    <h1>Gestión de Productos</h1>

    <!-- 🔹 FORMULARIO -->
    <div class="product-form">
      <h2>Agregar / Editar Producto</h2>

      <form method="post" action="<?= base_url('productos/guardar') ?>">

        <input type="hidden" name="id">

        <input type="text" name="nombre" placeholder="Nombre del producto" required>

        <input type="number" name="precio" placeholder="Precio sugerido" required>

        <input type="text" name="medida" placeholder="Medida (ej: 2 manojos, 3 libras)" required>

        <input type="number" name="cantidad" placeholder="Cantidad disponible" required>

        <!-- 🔥 MOSTRAR EN TIENDA -->
        <div class="checkbox-container">
          <label>
            <input type="checkbox" name="activo" value="1" checked>
            Mostrar en tienda
          </label>
        </div>

        <div class="form-buttons">
          <button type="submit">Guardar</button>
          <button type="reset">Cancelar</button>
        </div>

      </form>
    </div>

    <!-- 🔹 LISTA DE PRODUCTOS -->
    <div class="product-list">
      <h2>Mis Productos</h2>

      <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $p): ?>
          
          <div class="product-item">
            <div class="product-info">
              <p><strong><?= esc($p['nombre']) ?></strong></p>
              <p>Q<?= esc($p['precio']) ?> - <?= esc($p['medida']) ?></p>
              <p>Cantidad: <?= esc($p['cantidad']) ?></p>
            </div>

            <button class="btn-edit"
              onclick="editarProducto(
                <?= $p['id'] ?>,
                '<?= esc($p['nombre']) ?>',
                <?= $p['precio'] ?>,
                '<?= esc($p['medida']) ?>',
                <?= $p['cantidad'] ?>,
                <?= $p['activo'] ?>
              )"
            >
              Editar
            </button>
          </div>

        <?php endforeach; ?>
      <?php endif; ?>

    </div>

  </div>


  <script>
    function editarProducto(id, nombre, precio, medida, cantidad, activo) {
      document.querySelector('input[name="id"]').value = id;
      document.querySelector('input[name="nombre"]').value = nombre;
      document.querySelector('input[name="precio"]').value = precio;
      document.querySelector('input[name="medida"]').value = medida;
      document.querySelector('input[name="cantidad"]').value = cantidad;
      document.querySelector('input[name="activo"]').checked = activo == 1;
    }
  </script>

</body>
</html>