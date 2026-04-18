<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

<div class="users-container">

  <button class="btn-back" onclick="window.location.href='<?= base_url('admin') ?>'">
    ⬅ Volver al inicio
  </button>

  <h1>Gestión de Usuarios</h1>

  <div class="users-list">

    <?php if (!empty($usuarios)): ?>

      <?php foreach ($usuarios as $u): ?>

        <div class="user-item">

          <div class="user-info">
            <p><strong><?= esc($u['nombre']) ?></strong></p>
            <p>Usuario: <?= esc($u['username']) ?></p>
            <p>Rol: <?= ucfirst($u['rol']) ?></p>
          </div>

          <?php if ($u['id'] != session('id')): ?>
            <a href="<?= base_url('admin/eliminar/'.$u['id']) ?>">
              <button class="btn-delete">Eliminar</button>
            </a>
          <?php else: ?>
            <button class="btn-disabled" disabled>Actual</button>
          <?php endif; ?>

        </div>

      <?php endforeach; ?>

    <?php else: ?>
      <p>No hay usuarios registrados</p>
    <?php endif; ?>

  </div>

</div>

</body>
</html>