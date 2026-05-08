<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel de Administración | Trux-up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/estilos.css">
  <script src="https://kit.fontawesome.com/4df0087ba8.js" crossorigin="anonymous"></script>
  <script type="module" src="js/admin.js"></script>
  <style>
    :root {
      --trux-admin-blue: #0056FF;
      --trux-admin-dark: #002B5B;
    }
    body { background: #f8f9fa; font-family: 'Inter', sans-serif; padding-top: 0 !important; }
    .admin-navbar { background: var(--trux-admin-blue); box-shadow: 0 2px 10px rgba(0,86,255,0.2); padding: 0.8rem 1rem; }
    .nav-tabs { border-bottom: 2px solid #dee2e6; gap: 10px; }
    .nav-tabs .nav-link { border: none; color: #666; font-weight: 600; padding: 12px 20px; border-radius: 8px 8px 0 0; transition: all 0.3s; }
    .nav-tabs .nav-link:hover { background: #f1f1f1; }
    .nav-tabs .nav-link.active { color: var(--trux-admin-blue); border-bottom: 3px solid var(--trux-admin-blue); background: transparent; }
    
    .stat-card { border: none; border-radius: 15px; transition: transform 0.3s, box-shadow 0.3s; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .stat-icon-bg { position: absolute; right: 20px; bottom: 20px; font-size: 3rem; opacity: 0.1; }
    
    .category-label { display: flex; justify-content: space-between; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem; }
    .progress { height: 8px; border-radius: 10px; background: #eee; margin-bottom: 5px; }
    .progress-bar { border-radius: 10px; background: var(--trux-admin-blue); }

    /* Estilos Premium para Tablas */
    .table thead th { font-weight: 700; color: #888; letter-spacing: 0.5px; border-bottom: 2px solid #f1f1f1; }
    .table tbody tr { transition: background 0.2s; }
    .table tbody tr:hover { background-color: #fbfcfe !important; }
    
    .badge { font-weight: 600; letter-spacing: 0.3px; padding: 0.5em 1em; }
    .bg-warning-subtle { background-color: #FFF3E0 !important; color: #EF6C00 !important; }
    .bg-info-subtle { background-color: #E3F2FD !important; color: #1565C0 !important; }
    .bg-success-subtle { background-color: #E8F5E9 !important; color: #2E7D32 !important; }
    .bg-danger-subtle { background-color: #FFEBEE !important; color: #C62828 !important; }

    .sidebar-admin { background: white; border-right: 1px solid #eee; height: calc(100vh - 60px); position: sticky; top: 60px; }
    .sidebar-link { padding: 12px 20px; display: flex; align-items: center; color: #555; text-decoration: none; border-radius: 10px; margin: 4px 10px; transition: all 0.2s; font-weight: 500; }
    .sidebar-link i { width: 25px; font-size: 1.1rem; }
    .sidebar-link:hover { background: #f5f8ff; color: var(--trux-admin-blue); }
    .sidebar-link.active { background: var(--trux-admin-blue); color: white; }
    .admin-section { animation: fadeIn 0.4s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body>
    <!-- Toast Container para notificaciones -->
    <div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100; margin-top: 60px;"></div>

    <!-- Navbar Estilo Imagen -->
    <nav class="navbar navbar-expand-lg admin-navbar sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="#">
          <i class="fa-solid fa-shield me-2"></i> Trux-up Admin Panel
        </a>
        <div class="ms-auto d-flex align-items-center gap-4 text-white-50">
          <a href="index.html" class="btn btn-sm btn-outline-light rounded-pill px-3 border-white-50 text-white-50" style="font-size: 0.8rem;">
            <i class="fa-solid fa-house me-1"></i> Volver al Sitio
          </a>
          <a href="#" class="text-white-50 text-decoration-none small"><i class="fa-solid fa-bell me-1"></i> Notificaciones</a>
          <a href="#" class="text-white fs-4"><i class="fa-solid fa-user-circle"></i></a>
        </div>
      </div>
    </nav>

    <div class="container-fluid p-lg-5 p-4">
      <!-- Header Título -->
      <div class="mb-5">
        <h1 class="fw-bold" style="color: var(--trux-admin-dark); font-size: 2.5rem;">
          <i class="fa-solid fa-chart-line text-primary me-3"></i>Panel de Administración
        </h1>
        <p class="text-muted fs-5">Gestiona estadísticas de productos y pedidos</p>
      </div>

      <!-- Tabs de Navegación -->
      <ul class="nav nav-tabs mb-5" id="adminTabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#estadisticas">
            <i class="fa-solid fa-chart-bar me-2"></i>Estadísticas por Categoría
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#pedidos">
            <i class="fa-solid fa-boxes-stacked me-2"></i>Gestión de Pedidos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#productos">
            <i class="fa-solid fa-box me-2"></i>Gestión de Catálogo
          </a>
        </li>
        <li class="nav-item ms-auto d-flex gap-2 align-items-center">
          <button id="btn-clear-cache" class="btn btn-outline-warning btn-sm rounded-pill px-3">
            <i class="fa-solid fa-broom me-1"></i>Limpiar Cache
          </button>
          <a href="index.html" class="btn btn-sm btn-light text-primary fw-bold rounded-pill px-4 shadow-sm border-0 transition-hover">
            <i class="fa-solid fa-arrow-left-long me-2"></i>Tienda
          </a>
        </li>
      </ul>

      <div class="tab-content">
        <!-- SECCIÓN 1: ESTADÍSTICAS (FIEL A LA IMAGEN) -->
        <section class="tab-pane fade show active admin-section" id="estadisticas">
          <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
              <div class="card stat-card" style="border-left: 5px solid #0056FF;">
                <div class="card-body p-4 position-relative">
                  <p class="text-muted small mb-1">Total de Ventas</p>
                  <h3 class="fw-bold mb-2" style="color: #0056FF;">S/. 45,320.50</h3>
                  <small class="text-success"><i class="fa-solid fa-arrow-up me-1"></i>+12% vs mes anterior</small>
                  <i class="fa-solid fa-money-bill-wave stat-icon-bg" style="color: #0056FF;"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card stat-card" style="border-left: 5px solid #FF7A00;">
                <div class="card-body p-4 position-relative">
                  <p class="text-muted small mb-1">Productos Vendidos</p>
                  <h3 class="fw-bold mb-2" style="color: #FF7A00;">847 unidades</h3>
                  <small class="text-success"><i class="fa-solid fa-arrow-up me-1"></i>+8% vs mes anterior</small>
                  <i class="fa-solid fa-box stat-icon-bg" style="color: #FF7A00;"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card stat-card" style="border-left: 5px solid #28a745;">
                <div class="card-body p-4 position-relative">
                  <p class="text-muted small mb-1">Pedidos Completados</p>
                  <h3 class="fw-bold mb-2" style="color: #28a745;">156 pedidos</h3>
                  <small class="text-success"><i class="fa-solid fa-arrow-up me-1"></i>+5% vs mes anterior</small>
                  <i class="fa-solid fa-check-circle stat-icon-bg" style="color: #28a745;"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card stat-card" style="border-left: 5px solid #D32F2F;">
                <div class="card-body p-4 position-relative">
                  <p class="text-muted small mb-1">Pedidos Pendientes</p>
                  <h3 class="fw-bold mb-2" style="color: #D32F2F;">23 pedidos</h3>
                  <small class="text-danger"><i class="fa-solid fa-arrow-down me-1"></i>-3% vs mes anterior</small>
                  <i class="fa-solid fa-hourglass-end stat-icon-bg" style="color: #D32F2F;"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="card border-0 shadow-sm p-lg-5 p-4 rounded-4" style="background: white;">
            <h3 class="fw-bold mb-4" style="color: var(--trux-admin-dark);">
              <i class="fa-solid fa-chart-pie text-primary me-2"></i>Ventas por Categoría
            </h3>
            <div class="row g-4">
              <!-- Renderizado dinámico de categorías (Muestra de diseño) -->
              <div class="col-md-6">
                <div class="category-label"><span>Ropa</span><span class="text-primary">15%</span></div>
                <div class="progress"><div class="progress-bar" style="width: 15%"></div></div>
                <small class="text-muted">127 unidades vendidas</small>
              </div>
              <div class="col-md-6">
                <div class="category-label"><span>Electrónica</span><span class="text-primary">18%</span></div>
                <div class="progress"><div class="progress-bar" style="width: 18%"></div></div>
                <small class="text-muted">152 unidades vendidas</small>
              </div>
              <div class="col-md-6">
                <div class="category-label"><span>Computadoras y Laptops</span><span class="text-primary">22%</span></div>
                <div class="progress"><div class="progress-bar" style="width: 22%"></div></div>
                <small class="text-muted">186 unidades vendidas</small>
              </div>
              <div class="col-md-6">
                <div class="category-label"><span>Accesorios de Cómputo</span><span class="text-primary">12%</span></div>
                <div class="progress"><div class="progress-bar" style="width: 12%"></div></div>
                <small class="text-muted">101 unidades vendidas</small>
              </div>
            </div>
          </div>
        </section>

        <!-- SECCIÓN 2: PEDIDOS -->
        <section class="tab-pane fade admin-section" id="pedidos">
          <div class="card border-0 shadow-sm p-4">
            <h3 class="fw-bold mb-4">Lista de Pedidos</h3>
            <div class="table-responsive">
              <table class="table table-hover align-middle border-0">
                <thead class="bg-light text-muted small text-uppercase">
                  <tr>
                    <th class="ps-3 border-0">ID Pedido</th>
                    <th class="border-0">Cliente</th>
                    <th class="border-0">Fecha</th>
                    <th class="border-0">Total</th>
                    <th class="border-0">Estado</th>
                    <th class="border-0 text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody id="admin-orders-table">
                  <!-- Se llena dinámicamente -->
                  <tr>
                    <td colspan="6" class="text-center py-5">
                      <div class="spinner-border text-primary spinner-border-sm me-2"></div>
                      Cargando pedidos...
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>

          <!-- SECTION: Gestión de Productos -->
          <section id="productos" class="tab-pane fade admin-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h3 class="fw-bold" style="color: var(--trux-admin-dark);">Gestión de Catálogo</h3>
              <div class="d-flex gap-2">
                <div class="input-group input-group-sm" style="max-width: 250px;">
                  <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-search text-muted"></i></span>
                  <input type="text" class="form-control border-start-0" id="admin-product-search" placeholder="Buscar producto...">
                </div>
                <button id="btn-nuevo-producto" class="btn btn-primary px-4 rounded-pill shadow-sm"><i class="fa-solid fa-plus me-2"></i>Nuevo Producto</button>
              </div>
            </div>
            <div class="card border-0 shadow-sm overflow-hidden rounded-4">
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead class="table-light">
                    <tr style="border-bottom: 2px solid #eee;">
                      <th class="ps-4">Imagen</th>
                      <th>Nombre del Producto</th>
                      <th>Categoría</th>
                      <th>Precio</th>
                      <th>Stock</th>
                      <th>Estado</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="admin-products-table">
                    <!-- Se llena vía JS -->
                  </tbody>
                </table>
              </div>
            </div>
          </section>
      </div>
    </div>
    
    <!-- Modal: Nuevo Producto -->
    <div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header bg-primary text-white border-0 py-3">
            <h5 class="modal-title fw-bold"><i class="fa-solid fa-plus-circle me-2"></i>Registrar Nuevo Producto</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="form-nuevo-producto">
            <div class="modal-body p-4">
              <div class="row g-3">
                <div class="col-md-8">
                  <label class="form-label fw-bold">Nombre del Producto</label>
                  <input type="text" name="name" class="form-control rounded-3" placeholder="Ej. Laptop HP Pavilion 15" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label fw-bold">Categoría</label>
                  <select name="category_id" id="select-categorias" class="form-select rounded-3" required>
                    <option value="">Cargando...</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label fw-bold">Precio (S/.)</label>
                  <input type="number" step="0.01" name="price" class="form-control rounded-3" placeholder="0.00" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label fw-bold">Stock Inicial</label>
                  <input type="number" name="stock" class="form-control rounded-3" value="50" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label fw-bold">Imagen (Archivo)</label>
                  <input type="file" name="image" class="form-control rounded-3" accept="image/*" required>
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold">Descripción</label>
                  <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Breve descripción del producto..."></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
              <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Guardar Producto</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal: Cambiar Estado Pedido -->
    <div class="modal fade" id="modalStatus" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-dark text-white border-0 py-2">
            <h6 class="modal-title fw-bold">Actualizar Estado</h6>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-3">
            <input type="hidden" id="status-order-id">
            <div class="list-group list-group-flush rounded-3 border">
              <button type="button" onclick="updateOrderStatus('processing')" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                <span class="p-1 rounded-circle bg-warning"></span> En Proceso
              </button>
              <button type="button" onclick="updateOrderStatus('shipped')" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                <span class="p-1 rounded-circle bg-info"></span> Enviado
              </button>
              <button type="button" onclick="updateOrderStatus('delivered')" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                <span class="p-1 rounded-circle bg-success"></span> Entregado
              </button>
              <button type="button" onclick="updateOrderStatus('cancelled')" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                <span class="p-1 rounded-circle bg-danger"></span> Cancelado
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/alerts.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>