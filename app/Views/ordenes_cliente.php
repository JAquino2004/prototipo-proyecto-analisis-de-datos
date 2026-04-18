<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Órdenes</title>
  <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>

  <div class="orders-container">

    <!-- 🔙 VOLVER -->
    <button class="btn-back" onclick="window.location.href='comprador.html'">
      ⬅ Volver al inicio
    </button>

    <h1>Mis Órdenes</h1>

    <!-- 🔹 FILTROS -->
    <div class="order-filters">
      <button class="filter-btn active">Pendientes</button>
      <button class="filter-btn">Entregadas</button>
      <button class="filter-btn">Canceladas</button>
    </div>

    <!-- 🔹 LISTA -->
    <div class="orders-list">

      <!-- ORDEN PENDIENTE -->
      <div class="order-card pending">

        <div class="order-header">
          <h3>Orden #101</h3>
          <span class="status pending">Pendiente</span>
        </div>

        <div class="order-body">
          <p><strong>Vendedor:</strong> Tienda XYZ</p>

          <p><strong>Productos:</strong></p>
          <ul>
            <li>Tomates - 2 libras</li>
          </ul>
        </div>

        <div class="order-actions">
          <button class="btn-chat">Abrir chat</button>
        </div>

      </div>

      <!-- ORDEN ENTREGADA -->
      <div class="order-card delivered">

        <div class="order-header">
          <h3>Orden #102</h3>
          <span class="status delivered">Entregado</span>
        </div>

        <div class="order-body">
          <p><strong>Vendedor:</strong> Mercado Central</p>

          <p><strong>Productos:</strong></p>
          <ul>
            <li>Papas - 1 saco</li>
          </ul>
        </div>

        <div class="order-actions">
          <button class="btn-chat">Abrir chat</button>
        </div>

      </div>

      <!-- ORDEN CANCELADA -->
      <div class="order-card cancelled">

        <div class="order-header">
          <h3>Orden #103</h3>
          <span class="status cancelled">Cancelada</span>
        </div>

        <div class="order-body">
          <p><strong>Vendedor:</strong> Juan Pérez</p>

          <p><strong>Productos:</strong></p>
          <ul>
            <li>Zanahoria - 5 unidades</li>
          </ul>
        </div>

        <div class="order-actions">
          <button class="btn-chat">Abrir chat</button>
        </div>

      </div>

    </div>

  </div>

</body>
</html>