<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

<div class="login-container">
  <h1>Registrarse</h1>

  <?php if (session()->getFlashdata('error')): ?>
    <p style="color:red"><?= session()->getFlashdata('error') ?></p>
  <?php endif; ?>

  <form method="post" action="<?= base_url('register') ?>">

    <div class="input-group">
      <label>Nombre</label>
      <input type="text" name="nombre" required>
    </div>

    <div class="input-group">
      <label>Usuario</label>
      <input type="text" name="username" required>
    </div>

    <div class="input-group">
      <label>Telefono</label>
      <input type="text" name="telefono" required>
    </div>

    <div class="input-group">
      <label>Contraseña</label>
      <input type="password" name="password" required>
    </div>

    <div class="input-group">
      <label>Rol</label>
      <select name="rol">
        <option value="comprador">Comprador</option>
        <option value="vendedor">Vendedor</option>
      </select>
    </div>

    <button type="submit" class="btn-login">Crear cuenta</button>

  </form>
</div>

</body>
</html>