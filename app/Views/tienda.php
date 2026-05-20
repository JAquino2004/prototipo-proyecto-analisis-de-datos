<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tienda</title>

  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="store-container">

    <!--  HEADER -->
    <div class="store-header">

      <button
        class="btn-back"
        onclick="window.location.href='<?= base_url('comprador') ?>'"
      >
        ⬅ Volver al inicio
      </button>

      <a href="<?= base_url('carrito') ?>" class="btn-cart">
        🛒 Ver carrito
      </a>

    </div>

    <h1>Productos disponibles</h1>

    <div class="store-grid">

      <?php if (!empty($productos)): ?>

        <?php foreach ($productos as $p): ?>

          <div class="store-card">

            <!-- 🔥 NOMBRE -->
            <h3><?= esc($p['nombre']) ?></h3>

            <!-- 🔥 VENDEDOR -->
            <p>
              <strong>Vendedor:</strong>
              <?= esc($p['vendedor_nombre']) ?>
            </p>

            <!-- 🔥 PRECIO -->
            <p>
              <strong>Precio:</strong>
              Q<?= esc($p['precio']) ?>
            </p>

            <!-- 🔥 MEDIDA -->
            <p>
              <strong>Medida:</strong>
              <?= esc($p['medida']) ?>
            </p>

            <!-- 🔥 DISPONIBLE -->
            <p>
              <strong>Disponible:</strong>
              <?= esc($p['cantidad']) ?>
            </p>

            <!-- 🔥 FORMULARIO -->
            <form
              method="post"
              action="<?= base_url('carrito/agregar') ?>"
            >

              <input
                type="hidden"
                name="producto_id"
                value="<?= $p['id'] ?>"
              >

              <input
                type="number"
                name="cantidad"
                value="1"
                min="1"
                max="<?= $p['cantidad'] ?>"
                required
              >

              <button type="submit" class="btn-add">
                Agregar al carrito
              </button>

            </form>

          </div>

        <?php endforeach; ?>

      <?php else: ?>

        <p>No hay productos disponibles</p>

      <?php endif; ?>

    </div>

  </div>

</body>
</html>