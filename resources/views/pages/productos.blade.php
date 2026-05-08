@extends('layouts.app')

@section('title', 'Acerca | Trux-up')

@section('content')

<!-- Hero -->
<section class="hero-section py-5" style="background: linear-gradient(135deg, var(--trux-dark) 0%, var(--trux-primary) 100%);">
  <div class="container text-center py-4">
    <h1 class="display-4 fw-bold text-white mb-3">Catálogo de <span class="text-primary-gradient">Excelencia</span></h1>
    <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 600px;">Descubre nuestra selección premium en tecnología, moda y accesorios con garantía Trux-up.</p>
    <div class="d-flex justify-content-center align-items-center gap-3 auth-guest flex-wrap mt-2">
      <a href="login.html" class="btn btn-light btn-lg fw-bold px-4 rounded-pill">
        <i class="fa-solid fa-lock me-2"></i>Iniciar Sesión
      </a>
      <a href="registro.html" class="btn btn-outline-light btn-lg fw-bold px-4 rounded-pill">
        Regístrate
      </a>
    </div>
  </div>
</section>

<!-- Contenido Principal -->
<section style="padding:50px 0;background:var(--bg-color);">
  <div class="container">

    <!-- Barra superior: filtros mobile + sort -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
      <div class="d-flex align-items-center gap-3 flex-wrap">
        <div class="input-group" style="max-width:260px;">
          <span class="input-group-text" style="background:var(--bg-card);border-color:var(--border-color);"><i class="fa-solid fa-search text-muted"></i></span>
          <input type="text" class="form-control" id="product-search" placeholder="Buscar producto..." style="border-color:var(--border-color);">
        </div>
        <button class="btn btn-outline-primary d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
          <i class="fa-solid fa-filter me-1"></i>Filtros
        </button>
      </div>
      <div class="d-flex align-items-center gap-2">
        <label class="text-muted small fw-bold mb-0">Ordenar:</label>
        <select class="form-select form-select-sm" id="filter-sort" style="width:auto;border-color:var(--border-color);">
          <option value="default">Relevancia</option>
          <option value="price-asc">Precio: menor a mayor</option>
          <option value="price-desc">Precio: mayor a menor</option>
          <option value="rating">Mejor calificados</option>
          <option value="name">Nombre A-Z</option>
        </select>
      </div>
    </div>

    <div class="row g-4">
      <!-- Sidebar filtros (desktop) -->
      <div class="col-lg-3 d-none d-lg-block">
        <div class="filter-sidebar">
          <h5 class="filter-title"><i class="fa-solid fa-filter me-2" style="color:var(--trux-primary);"></i>Filtros</h5>
          <div class="mb-4">
            <label class="mb-2">Categoría</label>
            <select class="form-select form-select-sm" id="filter-category">
              <option value="todos">Todas las categorías</option>
              <option value="Ropa">Ropa</option>
              <option value="Electrónica">Electrónica</option>
              <option value="Computadoras y Laptops">Computadoras y Laptops</option>
              <option value="Accesorios de Cómputo">Accesorios de Cómputo</option>
              <option value="Periféricos">Periféricos</option>
              <option value="Telefonía">Telefonía</option>
              <option value="Hogar y Oficina">Hogar y Oficina</option>
              <option value="Audio y Sonido">Audio y Sonido</option>
              <option value="Gaming">Gaming</option>
              <option value="Accesorios Personales">Accesorios Personales</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="mb-2">Rango de Precio (S/.)</label>
            <div class="d-flex align-items-center gap-2">
              <input type="number" class="form-control form-control-sm" id="filter-price-min" placeholder="Min">
              <span>-</span>
              <input type="number" class="form-control form-control-sm" id="filter-price-max" placeholder="Max">
            </div>
          </div>
          <div class="mb-4">
            <label class="mb-2">Calificación Mínima</label>
            <select class="form-select form-select-sm" id="filter-rating">
              <option value="0">Cualquier calificación</option>
              <option value="4">4+ estrellas</option>
              <option value="3">3+ estrellas</option>
            </select>
          </div>
          <button class="btn btn-primary w-100 fw-bold py-2" id="reset-filters">
            <i class="fa-solid fa-rotate-left me-2"></i>Resetear Filtros
          </button>
        </div>
      </div>

      <!-- Área de productos DINÁMICA -->
      <div class="col-lg-9" id="products-catalog-container">
        <div id="no-results" class="text-center py-5 d-none">
          <i class="fa-solid fa-search fa-4x text-muted mb-4 d-block"></i>
          <h3 class="fw-bold">No encontramos lo que buscas</h3>
          <p class="text-muted">Prueba ajustando los filtros o el término de búsqueda.</p>
          <button class="btn btn-primary mt-3" onclick="document.getElementById('reset-filters').click()">
            Ver todos los productos
          </button>
        </div>
        <div class="text-center py-5" id="loading-products">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-3 text-muted fw-bold">Cargando catálogo premium...</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Offcanvas Filtros Mobile -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
  <div class="offcanvas-header navbar-truxup">
    <h5 class="offcanvas-title text-white" id="filterOffcanvasLabel"><i class="fa-solid fa-filter me-2"></i>Filtros</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="mb-4">
      <label class="form-label fw-bold">Buscar</label>
      <input type="text" class="form-control" id="mobile-product-search" placeholder="Nombre del producto...">
    </div>
    <div class="mb-4">
      <label class="form-label fw-bold">Categoría</label>
      <select class="form-select" id="mobile-filter-category">
        <option value="todos">Todas las categorías</option>
        <option value="Ropa">Ropa</option>
        <option value="Electrónica">Electrónica</option>
        <option value="Computadoras y Laptops">Computadoras y Laptops</option>
        <option value="Accesorios de Cómputo">Accesorios de Cómputo</option>
        <option value="Periféricos">Periféricos</option>
        <option value="Telefonía">Telefonía</option>
        <option value="Hogar y Oficina">Hogar y Oficina</option>
        <option value="Audio y Sonido">Audio y Sonido</option>
        <option value="Gaming">Gaming</option>
        <option value="Accesorios Personales">Accesorios Personales</option>
      </select>
    </div>
    <div class="mb-4">
      <label class="form-label fw-bold">Precio</label>
      <div class="d-flex gap-2">
        <input type="number" class="form-control" id="mobile-filter-price-min" placeholder="Mín">
        <input type="number" class="form-control" id="mobile-filter-price-max" placeholder="Máx">
      </div>
    </div>
    <div class="mb-4">
      <label class="form-label fw-bold">Calificación</label>
      <select class="form-select" id="mobile-filter-rating">
        <option value="0">Todas</option>
        <option value="4">4+ estrellas</option>
        <option value="3">3+ estrellas</option>
      </select>
    </div>
    <div class="mb-4">
      <label class="form-label fw-bold">Ordenar</label>
      <select class="form-select" id="mobile-filter-sort">
        <option value="default">Relevancia</option>
        <option value="price-asc">Precio: menor a mayor</option>
        <option value="price-desc">Precio: mayor a menor</option>
        <option value="rating">Mejor calificados</option>
      </select>
    </div>
    <button class="btn btn-primary w-100 fw-bold" id="mobile-reset-filters" data-bs-dismiss="offcanvas">
      Resetear y Aplicar
    </button>
  </div>
</div>

<div id="global-footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/alerts.js"></script>
<script src="js/cart.js"></script>
<script src="js/filters.js"></script>
<script type="module">
  import { fetchProducts, initProductsGrid } from './js/products.js';

  document.addEventListener('DOMContentLoaded', async () => {
    try {
      const products = await fetchProducts();
      const loader = document.getElementById('loading-products');
      if (loader) loader.remove();
      
      initProductsGrid('products-catalog-container', products);
      
      // Re-inicializar filtros para capturar los productos recién renderizados
      if (window.initProductFilters) {
        window.initProductFilters();
      }
    } catch (err) {
      console.error("Error initializing products page:", err);
    }
  });
</script>

</body>
</html>
