<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Admin</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

<div class="dashboard">

  <h1>Panel de Administración</h1>

  <div class="dashboard-grid">

    <!-- 👤 USUARIOS -->
    <div class="card">
      <h2>👤 Usuarios</h2>
      <p>Administrar usuarios del sistema</p>
      <button onclick="window.location.href='<?= base_url('admin/usuarios') ?>'">
        Ir
      </button>
    </div>

    <!-- 📦 PRODUCTOS -->
    <div class="card">
      <h2>📦 Productos</h2>
      <p>Gestionar productos disponibles</p>
      <button onclick="window.location.href='<?= base_url('admin/productos') ?>'">
        Ir
      </button>
    </div>

  </div>

</div>

</body>
</html>