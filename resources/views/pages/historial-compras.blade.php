@extends('layouts.app')

@section('title', 'Acerca | Trux-up')

@section('content')
<!-- Hero -->
<section style="background:linear-gradient(135deg,#0056FF 0%,#003d99 100%);padding:50px 0;">
  <div class="container text-center">
    <h1 class="fw-bold text-white mb-1">Mis Compras</h1>
    <p style="color:rgba(255,255,255,0.85);">Historial completo de tus pedidos y transacciones</p>
  </div>
</section>

<!-- Main -->
<section style="padding:50px 0;background:var(--bg-color);min-height:calc(100vh - 250px);">
  <div class="container">
    <!-- Filtros -->
    <div class="p-4 rounded-3 mb-4" style="background:var(--bg-card);border:1px solid var(--border-color);">
      <div class="row g-3">
        <div class="col-md-5">
          <label class="form-label fw-bold small" style="color:var(--trux-dark);">Buscar por número de pedido</label>
          <input type="text" class="form-control" id="order-search" placeholder="Ej: PED-001">
        </div>
        <div class="col-md-4">
          <label class="form-label fw-bold small" style="color:var(--trux-dark);">Estado del pedido</label>
          <select class="form-select" id="order-status-filter">
            <option value="">Todos los estados</option>
            <option value="delivered">Entregado</option>
            <option value="transit">En tránsito</option>
            <option value="processing">Procesando</option>
            <option value="cancelled">Cancelado</option>
          </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
          <button class="btn btn-outline-secondary w-100" onclick="document.getElementById('order-search').value='';document.getElementById('order-status-filter').value='';renderOrders();">
            <i class="fa-solid fa-rotate-left me-1"></i>Limpiar
          </button>
        </div>
      </div>
    </div>

    <!-- Lista de órdenes -->
    <div id="orders-list"></div>

    <div class="mt-4">
      <a href="perfil.html" class="btn btn-outline-primary fw-bold">
        <i class="fa-solid fa-arrow-left me-2"></i>Volver al Perfil
      </a>
    </div>
  </div>
</section>

<div id="global-footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/alerts.js"></script>
<script src="js/cart.js"></script>
<script>
// Verificar sesión
if (!localStorage.getItem('truxup-user')) {
  setTimeout(() => window.location.href = 'login.html', 100);
}

const statusLabel = { processing:'Procesando', delivered:'Entregado', transit:'En tránsito', cancelled:'Cancelado' };
const statusClass = { processing:'status-processing', delivered:'status-delivered', transit:'status-transit', cancelled:'status-cancelled' };
const statusIcon  = { processing:'fa-hourglass-half', delivered:'fa-check-circle', transit:'fa-truck', cancelled:'fa-times-circle' };

// Datos de muestra (se combinan con órdenes reales)
const sampleOrders = [
  { id: 'PED-2026-001', date: '28 de Abril, 2026', total: '2359.95', status: 'delivered',
    items: [{name:"Samsung Smart TV 55\"",qty:1},{name:"Apple MacBook Air M1",qty:1},{name:"Sony WH-1000XM5",qty:2}] },
  { id: 'PED-2026-002', date: '25 de Abril, 2026', total: '449.99', status: 'transit',
    items: [{name:"Lenovo IdeaPad 3",qty:1}] },
  { id: 'PED-2026-003', date: '22 de Abril, 2026', total: '199.98', status: 'processing',
    items: [{name:"JBL Flip 6 Speaker",qty:2}] }
];

function renderOrders() {
  const search = document.getElementById('order-search').value.toLowerCase();
  const statusF = document.getElementById('order-status-filter').value;
  const realOrders = JSON.parse(localStorage.getItem('truxup-orders') || '[]').map(o => ({
    id: o.id, date: o.date, total: o.total, status: o.status,
    items: (o.items || []).map(i => ({ name: i.name, qty: i.qty }))
  }));

  const all = [...realOrders, ...sampleOrders];
  const filtered = all.filter(o => {
    const matchSearch = !search || o.id.toLowerCase().includes(search);
    const matchStatus = !statusF || o.status === statusF;
    return matchSearch && matchStatus;
  });

  const container = document.getElementById('orders-list');
  if (!filtered.length) {
    container.innerHTML = `<div class="text-center py-5 text-muted"><i class="fa-solid fa-box-open fa-3x mb-3 d-block"></i><p>No se encontraron pedidos.</p></div>`;
    return;
  }

  container.innerHTML = filtered.map(o => `
    <div class="rounded-3 mb-4 overflow-hidden" style="background:var(--bg-card);border:1px solid var(--border-color);">
      <div class="p-4">
        <div class="row align-items-center g-3">
          <div class="col-lg-8">
            <div class="row g-2">
              <div class="col-6 col-md-3">
                <small class="text-muted d-block">Pedido</small>
                <strong style="color:var(--trux-dark);">#${o.id}</strong>
              </div>
              <div class="col-6 col-md-3">
                <small class="text-muted d-block">Fecha</small>
                <span class="fw-bold" style="color:var(--text-color);">${o.date}</span>
              </div>
              <div class="col-6 col-md-3">
                <small class="text-muted d-block">Total</small>
                <strong style="color:var(--trux-danger);">S/. ${o.total}</strong>
              </div>
              <div class="col-6 col-md-3">
                <small class="text-muted d-block">Estado</small>
                <span class="status-badge ${statusClass[o.status] || 'status-processing'}">
                  <i class="fa-solid ${statusIcon[o.status] || 'fa-hourglass'} me-1"></i>${statusLabel[o.status] || o.status}
                </span>
              </div>
            </div>
            <hr style="border-color:var(--border-color);">
            <div class="d-flex gap-2 flex-wrap">
              ${o.items.map(i => `<span class="badge text-primary fw-normal" style="background:rgba(0,86,255,0.1);padding:5px 10px;border-radius:6px;">${i.name} ×${i.qty}</span>`).join('')}
            </div>
          </div>
          <div class="col-lg-4 d-flex flex-column gap-2">
            <button class="btn btn-outline-primary fw-bold w-100" onclick="showToast('Detalles de pedido próximamente','info')">
              <i class="fa-solid fa-eye me-2"></i>Ver Detalles
            </button>
            ${o.status === 'delivered' ?
              `<button class="btn btn-primary fw-bold w-100" onclick="showToast('Descarga del recibo próximamente','info')"><i class="fa-solid fa-download me-2"></i>Descargar Recibo</button>` :
              o.status === 'processing' ?
              `<button class="btn fw-bold w-100" style="background:var(--trux-danger);color:white;" onclick="cancelOrder('${o.id}')"><i class="fa-solid fa-times me-2"></i>Cancelar Pedido</button>` :
              `<button class="btn btn-primary fw-bold w-100" onclick="showToast('Seguimiento próximamente','info')"><i class="fa-solid fa-truck me-2"></i>Rastrear Envío</button>`
            }
          </div>
        </div>
      </div>
    </div>`).join('');
}

function cancelOrder(id) {
  if (window.showConfirm) {
    window.showConfirm(
      'Cancelar Pedido',
      `¿Estás seguro de que deseas cancelar el pedido #${id}?`,
      () => {
        const orders = JSON.parse(localStorage.getItem('truxup-orders') || '[]');
        const idx = orders.findIndex(o => o.id === id);
        if (idx >= 0) {
          orders[idx].status = 'cancelled';
          localStorage.setItem('truxup-orders', JSON.stringify(orders));
          showToast('Pedido cancelado', 'warning');
          renderOrders();
        }
      }
    );
  } else {
    // Fallback if showConfirm not available
    const orders = JSON.parse(localStorage.getItem('truxup-orders') || '[]');
    const idx = orders.findIndex(o => o.id === id);
    if (idx >= 0) {
      orders[idx].status = 'cancelled';
      localStorage.setItem('truxup-orders', JSON.stringify(orders));
      showToast('Pedido cancelado', 'warning');
      renderOrders();
    }
  }
}

document.getElementById('order-search').addEventListener('input', renderOrders);
document.getElementById('order-status-filter').addEventListener('change', renderOrders);
document.addEventListener('DOMContentLoaded', renderOrders);
</script>
</body>
</html>
