<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio Vendedor</title>

  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="dashboard">

    <h1>Panel de Vendedor</h1>

    <div class="dashboard-grid">

      <div class="card">
        <h2>📦 Productos</h2>
        <p>Gestiona tus productos</p>

        <button onclick="window.location.href='<?= base_url('productos') ?>'">
          Ir
        </button>
      </div>

      <div class="card">
        <h2>🧾 Manejar Órdenes</h2>
        <p>Administra pedidos</p>

        <button onclick="window.location.href='<?= base_url('ordenes') ?>'">
          Ir
        </button>
      </div>

      <div class="card">
        <h2>📍 Manejar Ubicaciones</h2>
        <p>Administra ubicaciones</p>

        <button onclick="window.location.href='<?= base_url('ubicaciones') ?>'">
          Ir
        </button>
      </div>

    
      <div class="card">
        <h2>👤 Editar Perfil</h2>
        <p>Actualiza tu información personal</p>

        <button onclick="window.location.href='<?= base_url('perfil') ?>'">
          Ir
        </button>
      </div>

    </div>

  </div>

</body>
</html>