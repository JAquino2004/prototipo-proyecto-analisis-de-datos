<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio Comprador</title>

  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="dashboard">

    <h1>Panel de Comprador</h1>

    <div class="dashboard-grid">

      <div class="card">
        <h2>🛒 Ver Productos</h2>
        <p>Explora productos disponibles</p>
        <button onclick="window.location.href='<?= base_url('tienda') ?>'">
          Ir
        </button>
      </div>

      <div class="card">
        <h2>🧺 Carrito</h2>
        <p>Revisa tus productos seleccionados</p>
        <button onclick="window.location.href='<?= base_url('carrito') ?>'">
          Ir
        </button>
      </div>

      <div class="card">
        <h2>📦 Ver Órdenes</h2>
        <p>Consulta tus pedidos realizados</p>
        <button onclick="window.location.href='<?= base_url('ordenes') ?>'">
          Ir
        </button>
      </div>

    </div>

  </div>

</body>
</html>