<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Seleccionar Rol</title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="container">
    <h1>Selecciona tu tipo de usuario</h1>

    <div class="buttons">

      <!-- ADMIN -->
      <a href="<?= base_url('login/admin') ?>">
        <button class="btn admin">ADMIN</button>
      </a>

      <!-- COMPRADOR -->
      <a href="<?= base_url('login/comprador') ?>">
        <button class="btn comprador">COMPRADOR</button>
      </a>

      <!-- VENDEDOR -->
      <a href="<?= base_url('login/vendedor') ?>">
        <button class="btn vendedor">VENDEDOR</button>
      </a>

    </div>
  </div>

</body>
</html>