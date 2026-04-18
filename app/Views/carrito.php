<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

<div class="cart-container">

  <button class="btn-back" onclick="window.location.href='<?= base_url('comprador') ?>'">
    ⬅ Volver al inicio
  </button>

  <h1>Mi Carrito</h1>

  <?php if (!empty($carrito)): ?>
    <?php $total = 0; ?>

    <form method="post" action="<?= base_url('orden/guardar') ?>">

      <div class="cart-list">

        <?php foreach ($carrito as $item): ?>
          <?php $subtotal = $item['precio'] * $item['cantidad']; ?>
          <?php $total += $subtotal; ?>

          <div class="cart-item">

            <div class="cart-info">
              <p><strong><?= esc($item['nombre']) ?></strong></p>

              <!-- 🔥 VENDEDOR -->
              <p>Vendedor: <?= esc($item['vendedor_nombre']) ?></p>

              <p>Q<?= esc($item['precio']) ?></p>
              <p>Cantidad: <?= esc($item['cantidad']) ?></p>
              <p><strong>Subtotal: Q<?= $subtotal ?></strong></p>
            </div>

            <input type="number" value="<?= $item['cantidad'] ?>" min="1" disabled>

            <a href="<?= base_url('carrito/eliminar/'.$item['id']) ?>">
              <button type="button" class="btn-delete">Eliminar</button>
            </a>

          </div>

        <?php endforeach; ?>

      </div>

      <!-- 🔥 UBICACIONES -->
      <?php if (!empty($grupos)): ?>

        <h2>Seleccionar ubicaciones</h2>

        <?php foreach ($grupos as $vendedor_id => $grupo): ?>

          <div class="cart-item">

            <div class="cart-info">
              <p><strong><?= esc($grupo['nombre']) ?></strong></p>
            </div>

            <select name="ubicaciones[<?= $vendedor_id ?>]" required>
              <?php foreach ($grupo['ubicaciones'] as $u): ?>
                <option value="<?= $u['id'] ?>">
                  <?= esc($u['nombre']) ?> - <?= esc($u['direccion']) ?>
                </option>
              <?php endforeach; ?>
            </select>

          </div>

        <?php endforeach; ?>

      <?php endif; ?>

      <div class="cart-total">
        <h2>Total: Q<?= $total ?></h2>

        <a href="<?= base_url('carrito/vaciar') ?>">
          <button type="button" class="btn-delete">Vaciar carrito</button>
        </a>

        <button type="submit" class="btn-confirm">
          Finalizar compra
        </button>
      </div>

    </form>

  <?php else: ?>
    <p>Tu carrito está vacío</p>
  <?php endif; ?>

</div>

</body>
</html>