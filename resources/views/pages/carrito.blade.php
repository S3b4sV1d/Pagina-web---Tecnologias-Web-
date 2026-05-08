<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carrito de Compras | Trux-up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/estilos.css">
  <script src="https://kit.fontawesome.com/4df0087ba8.js" crossorigin="anonymous"></script>
  <script>window.BASE_URL = './';</script>
  <script type="module" src="js/layout.js"></script>
</head>
<body>

<div id="global-header"></div>

<!-- Cart Page -->
<section style="padding:40px 0;background:var(--bg-color);min-height:calc(100vh - 200px);">
  <div class="container">
    <div class="mb-4">
      <h1 class="fw-bold mb-1">
        <i class="fa-solid fa-shopping-cart me-2 text-primary"></i>Carrito de Compras
      </h1>
      <p class="text-muted" id="cart-count-text">Cargando...</p>
    </div>

    <div class="row g-4">
      <!-- Items -->
      <div class="col-lg-8">
        <div id="cart-page-items"></div>
      </div>
      <!-- Resumen -->
      <div class="col-lg-4">
        <div id="cart-page-summary" class="sticky-summary p-4 rounded-3" style="background:var(--bg-card);border:1px solid var(--border-color);position:sticky;top:80px;"></div>
      </div>
    </div>
  </div>
</section>

<div id="global-footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/alerts.js"></script>
<script src="js/cart.js"></script>
</body>
</html>
