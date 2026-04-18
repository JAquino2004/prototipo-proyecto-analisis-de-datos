<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="login-container">
    <h1>Iniciar Sesión (<?= esc($rol) ?>)</h1>

    <!-- 🔥 MENSAJE DE ERROR -->
    <?php if (session()->getFlashdata('error')): ?>
      <p style="color:red;">
        <?= session()->getFlashdata('error') ?>
      </p>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login') ?>">

      <!-- 🔥 IMPORTANTE: mandar rol oculto -->
      <input type="hidden" name="rol" value="<?= esc($rol) ?>">

      <div class="input-group">
        <label>Usuario</label>
        <input type="text" name="username" placeholder="Ingresa tu usuario" required>
      </div>

      <div class="input-group">
        <label>Contraseña</label>
        <input type="password" name="password" placeholder="Ingresa tu contraseña" required>
      </div>

      <!-- BOTONES -->
      <div class="button-group">
        <button type="submit" class="btn-login">Ingresar</button>
        <a href="<?= base_url('register') ?>">
        <button type="button" class="btn-register">Registrarse</button>
        </a>
      </div>

    </form>

  </div>

</body>
</html>