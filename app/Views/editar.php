<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>

    
    <link rel="stylesheet" href="<?= base_url('css/editar.css') ?>">

</head>
<body>

    <div class="edit-user-container">

        <h1>Editar Perfil</h1>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('perfil/actualizar/') ?>" method="POST">

            <div class="input-group">

                <label for="nombre">Nombre</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="<?= esc($usuario['nombre']) ?>"
                    required
                >

            </div>

            <div class="input-group">

                <label for="username">Usuario</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= esc($usuario['username']) ?>"
                    required
                >

            </div>

            <div class="input-group">

                <label for="telefono">Teléfono</label>

                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    value="<?= esc($usuario['telefono']) ?>"
                    required
                >

            </div>

            <div class="input-group">

                <label for="password">Nueva contraseña</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Opcional"
                >

            </div>

            <div class="input-group">

                <label for="confirmar_password">Confirmar contraseña</label>

                <input
                    type="password"
                    id="confirmar_password"
                    name="confirmar_password"
                    placeholder="Confirmar contraseña"
                >

            </div>

            

            <div class="button-group">

                <button type="submit" class="btn-login">
                    Guardar Cambios
                </button>

                <a 
    href="<?= session()->get('rol') == 'vendedor' 
        ? base_url('vendedor') 
        : base_url('comprador') ?>" 
    class="btn-register cancel-btn"
>
    Volver a Inicio
</a>

            </div>

        </form>

    </div>

</body>
</html>