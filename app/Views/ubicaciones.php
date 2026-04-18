<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Ubicaciones</title>

  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="products-container">

    <!-- 🔙 VOLVER -->
    <a href="<?= base_url('vendedor') ?>">
      <button class="btn-back">⬅ Volver al inicio</button>
    </a>

    <h1>Gestión de Ubicaciones</h1>

    <!-- 🔹 FORMULARIO -->
    <div class="product-form">
      <h2>Agregar / Editar Ubicación</h2>

      <form method="post" action="<?= base_url('ubicaciones/guardar') ?>">

        <input type="hidden" name="id">

        <input type="text" name="nombre" placeholder="Nombre (Ej: Mercado Central)" required>

        <textarea name="direccion" placeholder="Dirección detallada" required></textarea>

        <!-- 🔥 ACTIVO -->
        <div class="checkbox-container">
          <label>
            <input type="checkbox" name="activo" value="1" checked>
            Activa
          </label>
        </div>

        <div class="form-buttons">
          <button type="submit">Guardar</button>
          <button type="reset">Cancelar</button>
        </div>

      </form>
    </div>

    <!-- 🔹 LISTA -->
    <div class="product-list">
      <h2>Mis Ubicaciones</h2>

      <?php if (!empty($ubicaciones)): ?>
        <?php foreach ($ubicaciones as $u): ?>

          <div class="product-item">
            <div class="product-info">
              <p><strong><?= esc($u['nombre']) ?></strong></p>
              <p><?= esc($u['direccion']) ?></p>
              <p><?= $u['activo'] ? 'Activa' : 'Inactiva' ?></p>
            </div>

            <button class="btn-edit"
              onclick="editarUbicacion(
                <?= $u['id'] ?>,
                '<?= esc($u['nombre']) ?>',
                '<?= esc($u['direccion']) ?>',
                <?= $u['activo'] ?>
              )"
            >
              Editar
            </button>

          </div>

        <?php endforeach; ?>
      <?php endif; ?>

    </div>

  </div>

  <!-- 🔥 SCRIPT -->
  <script>
    function editarUbicacion(id, nombre, direccion, activo) {
      document.querySelector('input[name="id"]').value = id;
      document.querySelector('input[name="nombre"]').value = nombre;
      document.querySelector('textarea[name="direccion"]').value = direccion;
      document.querySelector('input[name="activo"]').checked = activo == 1;
    }
  </script>

</body>
</html>