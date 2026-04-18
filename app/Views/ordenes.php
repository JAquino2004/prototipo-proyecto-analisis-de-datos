<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Órdenes</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

<div class="orders-container">

  <button class="btn-back" onclick="window.location.href='<?= base_url(session('rol')) ?>'">
    ⬅ Volver al inicio
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

          <!-- HEADER -->
          <div class="order-header">
            <h3>Orden #<?= $orden['id'] ?></h3>

            <span class="status <?= $orden['estado'] ?>">
              <?= ucfirst($orden['estado']) ?>
            </span>
          </div>

          <!-- BODY -->
          <div class="order-body">

            <?php if (session('rol') === 'vendedor'): ?>
              <p><strong>Cliente:</strong> <?= esc($orden['cliente']) ?></p>
            <?php else: ?>
              <p><strong>Vendedor:</strong> <?= esc($orden['vendedor']) ?></p>
            <?php endif; ?>

            <p><strong>Productos:</strong></p>
            <ul>
              <?php foreach ($orden['productos'] as $p): ?>
                <li><?= esc($p['nombre']) ?> - <?= $p['cantidad'] ?></li>
              <?php endforeach; ?>
            </ul>

          </div>

          <!-- ACTIONS -->
          <div class="order-actions">

            <?php if (session('rol') === 'vendedor'): ?>

              <?php if ($orden['estado'] === 'pendiente'): ?>

                <a href="<?= base_url('orden/cambiar/'.$orden['id'].'/entregado') ?>">
                  <button class="btn-confirm">Marcar como entregado</button>
                </a>

                <a href="<?= base_url('orden/cambiar/'.$orden['id'].'/cancelado') ?>">
                  <button class="btn-cancel">Cancelar</button>
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