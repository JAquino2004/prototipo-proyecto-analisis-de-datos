<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

<div class="products-container">

  <button class="btn-back" onclick="window.location.href='<?= base_url('admin') ?>'">
    ⬅ Volver al inicio
  </button>

  <h1>Gestión de Productos</h1>

  <div class="product-list">

    <?php if (!empty($productos)): ?>

      <?php foreach ($productos as $p): ?>

        <div class="product-item">

          <img src="https://via.placeholder.com/80">

          <div class="product-info">
            <p><strong><?= esc($p['nombre']) ?></strong></p>
            <p>Q<?= esc($p['precio']) ?></p>
            <p>Medida: <?= esc($p['medida']) ?></p>
            <p>Disponible: <?= esc($p['cantidad']) ?></p>
            <p>Vendedor: <?= esc($p['vendedor'] ?? 'Sin vendedor') ?></p>
          </div>

          <a href="<?= base_url('admin/producto/eliminar/'.$p['id']) ?>">
            <button class="btn-delete">Eliminar</button>
          </a>

        </div>

      <?php endforeach; ?>

    <?php else: ?>

      <p>No hay productos</p>

    <?php endif; ?>

  </div>

</div>

</body>
</html>