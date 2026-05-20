<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Órdenes</title>

  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

<div class="orders-container">

  <button class="btn-back"
    onclick="window.location.href='<?= base_url(session('rol')) ?>'">
    Volver al inicio
  </button>

  <h1>Gestión de Órdenes</h1>

  <div class="order-filters">

    <button class="filter-btn <?= (!isset($estadoActual) ? 'active' : '') ?>"
      onclick="window.location.href='<?= base_url('ordenes') ?>'">
      Todas
    </button>

    <button class="filter-btn <?= ($estadoActual === 'pendiente' ? 'active' : '') ?>"
      onclick="window.location.href='<?= base_url('ordenes?estado=pendiente') ?>'">
      Pendientes
    </button>

    <button class="filter-btn <?= ($estadoActual === 'entregado' ? 'active' : '') ?>"
      onclick="window.location.href='<?= base_url('ordenes?estado=entregado') ?>'">
      Entregadas
    </button>

    <button class="filter-btn <?= ($estadoActual === 'cancelado' ? 'active' : '') ?>"
      onclick="window.location.href='<?= base_url('ordenes?estado=cancelado') ?>'">
      Canceladas
    </button>

  </div>

  <div class="orders-list">

    <?php if (!empty($ordenes)): ?>

      <?php foreach ($ordenes as $orden): ?>

        <div class="order-card">

          <div class="order-header">

            <h3>Orden #<?= $orden['id'] ?></h3>

            <span class="status <?= $orden['estado'] ?>">
              <?= ucfirst($orden['estado']) ?>
            </span>

          </div>

          <div class="order-body">

            <?php if (session('rol') === 'vendedor'): ?>

              <p>
                <strong>Cliente:</strong>
                <?= esc($orden['cliente']) ?>
              </p>

            <?php else: ?>

              <p>
                <strong>Vendedor:</strong>
                <?= esc($orden['vendedor']) ?>
              </p>

            <?php endif; ?>

            <p>
              <strong>Teléfono:</strong>
              <?= esc($orden['telefono']) ?>
            </p>

            <p><strong>Productos:</strong></p>

            <ul>

              <?php foreach ($orden['productos'] as $p): ?>

                <li>

                  <?php if (session('rol') === 'vendedor'): ?>

                    <form
                      action="<?= base_url('orden/detalle/actualizar/' . $p['detalle_id']) ?>"
                      method="POST"
                      style="margin-bottom:10px;"
                    >

                      <strong><?= esc($p['nombre']) ?></strong>

                      <br>

                      Cantidad:

                      <input
                        type="number"
                        name="cantidad"
                        value="<?= $p['cantidad'] ?>"
                        min="1"
                      >

                      Precio:

                      <input
                        type="number"
                        name="precio"
                        value="<?= $p['precio'] ?>"
                        step="0.01"
                      >

                      <button class="btn-edit" type="submit">
                        Guardar
                      </button>

                    </form>

                  <?php else: ?>

                    <?= esc($p['nombre']) ?>
                    -
                    <?= $p['cantidad'] ?>

                    -
                    Q<?= number_format($p['precio'], 2) ?>

                  <?php endif; ?>

                </li>

              <?php endforeach; ?>

            </ul>

          </div>

          <div class="order-actions">

            <a
              href="https://wa.me/502<?= $orden['telefono'] ?>?text=Hola%20te%20contacto%20por%20la%20orden%20%23<?= $orden['id'] ?>"
              target="_blank"
            >
              <button class="btn-chat">
                WhatsApp
              </button>
            </a>

            <?php if (session('rol') === 'vendedor'): ?>

              <?php if ($orden['estado'] === 'pendiente'): ?>

                <a href="<?= base_url('orden/cambiar/'.$orden['id'].'/entregado') ?>">

                  <button class="btn-confirm">
                    Marcar como entregado
                  </button>

                </a>

                <a href="<?= base_url('orden/cambiar/'.$orden['id'].'/cancelado') ?>">

                  <button class="btn-cancel">
                    Cancelar
                  </button>

                </a>

              <?php else: ?>

                <button class="btn-disabled" disabled>
                  <?= ucfirst($orden['estado']) ?>
                </button>

              <?php endif; ?>

            <?php else: ?>

              <button class="btn-disabled" disabled>
                <?= ucfirst($orden['estado']) ?>
              </button>

            <?php endif; ?>

          </div>

        </div>

      <?php endforeach; ?>

    <?php else: ?>

      <p>No hay órdenes</p>

    <?php endif; ?>

  </div>

</div>

</body>
</html>