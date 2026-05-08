<!doctype html>
@extends('layouts.app')

@section('title', 'Acerca | Trux-up')

@section('content')

  <!-- Profile Section -->
  <section style="padding:40px 0;background:var(--bg-color);min-height:calc(100vh - 200px);">
    <div class="container">
      <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4">
          <div class="p-4 rounded-3 text-center mb-3"
            style="background:var(--bg-card);border:1px solid var(--border-color);">
            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
              style="width:100px;height:100px;background:linear-gradient(135deg,var(--trux-primary),#003d99);font-size:2.5rem;color:white;">
              <i class="fa-solid fa-user"></i>
            </div>
            <h5 class="fw-bold mb-1" id="profile-name" style="color:var(--title-color);">Usuario</h5>
            <p class="small mb-0" style="color:var(--trux-primary);"><i class="fa-solid fa-circle-check me-1"></i>Cuenta
              Verificada</p>
          </div>
          <div>
            <a href="#perfil-info" class="profile-menu-item active"><i class="fa-solid fa-user"></i>Mi Información</a>
            <a href="#pedidos" class="profile-menu-item"><i class="fa-solid fa-box"></i>Mis Pedidos</a>
            <a href="#direcciones" class="profile-menu-item"><i class="fa-solid fa-map-marker-alt"></i>Direcciones</a>
            <a href="#seguridad" class="profile-menu-item"><i class="fa-solid fa-lock"></i>Seguridad</a>
            <a href="#" class="profile-menu-item logout"><i
                class="fa-solid fa-sign-out-alt"></i>Cerrar Sesión</a>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 col-md-8">
          <!-- Mi Información -->
          <div id="perfil-info" class="p-4 rounded-3 mb-4"
            style="background:var(--bg-card);border:1px solid var(--border-color);">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
              <h4 class="fw-bold mb-0" style="color:var(--title-color);">
                <i class="fa-solid fa-user me-2" style="color:var(--trux-primary);"></i>Mi Información
              </h4>
              <button class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#modalEditInfo">
                <i class="fa-solid fa-edit me-1"></i>Editar
              </button>
            </div>
            <div class="row g-3" id="user-info-grid">
              <div class="col-md-6"><label class="small fw-bold text-uppercase"
                  style="color:var(--trux-primary);">Nombre Completo</label>
                <p class="fw-bold mb-0" id="info-name" style="color:var(--title-color);">—</p>
              </div>
              <div class="col-md-6"><label class="small fw-bold text-uppercase"
                  style="color:var(--trux-primary);">Correo Electrónico</label>
                <p class="fw-bold mb-0" id="info-email" style="color:var(--title-color);">—</p>
              </div>
              <div class="col-md-6"><label class="small fw-bold text-uppercase"
                  style="color:var(--trux-primary);">Ciudad</label>
                <p class="fw-bold mb-0" id="info-city" style="color:var(--title-color);">—</p>
              </div>
              <div class="col-md-6"><label class="small fw-bold text-uppercase"
                  style="color:var(--trux-primary);">Estado</label>
                <p class="mb-0"><span class="status-badge status-delivered">Activo</span></p>
              </div>
            </div>
          </div>

          <!-- Mis Pedidos -->
          <div id="pedidos" class="p-4 rounded-3 mb-4 text-center"
            style="background:var(--bg-card);border:1px solid var(--border-color);">
            <div class="mb-4 pb-3 border-bottom">
              <i class="fa-solid fa-box d-block mb-2 mx-auto" style="color:var(--trux-primary); font-size: 2.5rem;"></i>
              <h4 class="fw-bold mb-0" style="color:var(--title-color);">Mis Pedidos Recientes</h4>
            </div>
            <div id="recent-orders">
              <div class="text-center py-4 text-muted">
                <p>No tienes pedidos aún. <a href="productos.html" style="color:var(--trux-primary);"
                    class="fw-bold">Explora productos</a></p>
              </div>
            </div>
          </div>

          <!-- Direcciones -->
          <div id="direcciones" class="p-4 rounded-3 mb-4"
            style="background:var(--bg-card);border:1px solid var(--border-color);">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
              <h4 class="fw-bold mb-0" style="color:var(--title-color);">
                <i class="fa-solid fa-map-marker-alt me-2" style="color:var(--trux-primary);"></i>Mis Direcciones
              </h4>
              <button class="btn btn-sm btn-primary" onclick="showToast('Función próximamente','info')">
                <i class="fa-solid fa-plus me-1"></i>Agregar
              </button>
            </div>
            <div class="d-flex justify-content-between align-items-start p-3 rounded"
              style="border:2px solid var(--border-color);">
              <div>
                <p class="fw-bold mb-1" style="color:var(--title-color);"><i class="fa-solid fa-home me-2"
                    style="color:var(--trux-primary);"></i>Dirección Principal</p>
                <p class="text-muted mb-0 ms-4" id="info-address-display">—</p>
              </div>
              <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalEditInfo">
                <i class="fa-solid fa-edit me-1"></i>Editar
              </button>
            </div>
          </div>

          <!-- Seguridad -->
          <div id="seguridad" class="p-4 rounded-3"
            style="background:var(--bg-card);border:1px solid var(--border-color);">
            <h4 class="fw-bold mb-4 pb-3 border-bottom" style="color:var(--trux-dark);">
              <i class="fa-solid fa-lock me-2" style="color:var(--trux-primary);"></i>Seguridad
            </h4>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <p class="fw-bold mb-1" style="color:var(--trux-dark);">Contraseña</p>
                <small class="text-muted">Protege tu cuenta con una contraseña segura</small>
              </div>
              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalPassword">
                <i class="fa-solid fa-key me-1"></i>Cambiar
              </button>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
              <div>
                <p class="fw-bold mb-1" style="color:var(--trux-dark);">Autenticación de 2 Factores</p>
                <small class="text-muted">Aumenta la seguridad de tu cuenta</small>
              </div>
              <button class="btn btn-sm btn-success" onclick="showToast('2FA próximamente','info')">
                <i class="fa-solid fa-shield-alt me-1"></i>Activar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Editar Información -->
  <div class="modal fade" id="modalEditInfo" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header navbar-truxup text-white">
          <h5 class="modal-title"><i class="fa-solid fa-user-edit me-2"></i>Editar Información</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formUpdateInfo">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold">Nombre Completo</label>
              <input type="text" class="form-control" id="edit-name" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Ciudad</label>
              <input type="text" class="form-control" id="edit-city" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Dirección</label>
              <input type="text" class="form-control" id="edit-address" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Cambiar Contraseña -->
  <div class="modal fade" id="modalPassword" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header navbar-truxup text-white">
          <h5 class="modal-title"><i class="fa-solid fa-key me-2"></i>Cambiar Contraseña</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formUpdatePass">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold">Nueva Contraseña</label>
              <input type="password" class="form-control" id="new-pass" required minlength="6">
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="confirm-new-pass" required minlength="6">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="global-footer"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="js/alerts.js"></script>
  <script src="js/cart.js"></script>
  <script type="module">
    import { checkAuth } from './js/auth.js';

    document.addEventListener('DOMContentLoaded', async () => {
      const user = await checkAuth();

      if (!user) {
        window.location.href = 'login.html';
        return;
      }

      // Poblar campos
      const fillData = (u) => {
        document.getElementById('profile-name').textContent = u.name || 'Usuario';
        document.getElementById('info-name').textContent = u.name || '—';
        document.getElementById('info-email').textContent = u.email || '—';
        document.getElementById('info-city').textContent = u.city || 'Lima';
        document.getElementById('info-address-display').textContent = u.address || 'Av. Principal 123, ' + (u.city || 'Lima');

        // Poblar modal
        document.getElementById('edit-name').value = u.name || '';
        document.getElementById('edit-city').value = u.city || '';
        document.getElementById('edit-address').value = u.address || '';
      };

      fillData(user);

      // Manejar Actualización de Info
      document.getElementById('formUpdateInfo').addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = {
          name: document.getElementById('edit-name').value.trim(),
          city: document.getElementById('edit-city').value.trim(),
          address: document.getElementById('edit-address').value.trim()
        };

        try {
          const res = await fetch('php/api.php?action=update_profile', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
          });
          const result = await res.json();
          if (result.success) {
            showToast('Información actualizada correctamente', 'success');
            bootstrap.Modal.getInstance(document.getElementById('modalEditInfo')).hide();
            // Recargar caché y UI
            const updatedUser = await checkAuth();
            if (updatedUser) fillData(updatedUser);
            window.location.reload(); // Forzar recarga para actualizar header y otros componentes
          } else {
            showToast(result.message || 'Error al actualizar', 'danger');
          }
        } catch (err) { console.error(err); }
      });

      // Manejar Cambio de Contraseña
      document.getElementById('formUpdatePass').addEventListener('submit', async (e) => {
        e.preventDefault();
        const pass = document.getElementById('new-pass').value;
        const confirm = document.getElementById('confirm-new-pass').value;

        if (pass !== confirm) {
          showToast('Las contraseñas no coinciden', 'danger');
          return;
        }

        try {
          const res = await fetch('php/api.php?action=update_password', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ password: pass })
          });
          const result = await res.json();
          if (result.success) {
            showToast('Contraseña actualizada correctamente', 'success');
            bootstrap.Modal.getInstance(document.getElementById('modalPassword')).hide();
            e.target.reset();
          } else {
            showToast(result.message || 'Error al actualizar', 'danger');
          }
        } catch (err) { console.error(err); }
      });
    });

    // Mostrar pedidos recientes desde la BD
    document.addEventListener('DOMContentLoaded', async () => {
      const container = document.getElementById('recent-orders');
      if (!container) return;

      try {
        const response = await fetch('php/api.php?action=get_orders');
        const orders = await response.json();

        if (orders.length) {
          const statusMap = { processing: 'Procesando', delivered: 'Entregado', transit: 'En tránsito', cancelled: 'Cancelado' };
          const statusClass = { processing: 'status-processing', delivered: 'status-delivered', transit: 'status-transit', cancelled: 'status-cancelled' };

          container.innerHTML = orders.slice(0, 3).map(o => `
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-3 border-bottom gap-2">
          <div class="d-flex align-items-center gap-3">
            <span class="fw-bold" style="color:var(--title-color);">${o.order_number}</span>
            <small class="text-muted">${new Date(o.date).toLocaleDateString()}</small>
          </div>
          <div class="d-flex align-items-center gap-3 ms-auto ms-sm-0">
            <strong style="color:var(--trux-danger);">S/. ${o.total}</strong>
            <span class="status-badge ${statusClass[o.status] || 'status-processing'}">${statusMap[o.status] || o.status}</span>
          </div>
        </div>`).join('');
        }
      } catch (err) {
        console.error('Error fetching orders:', err);
      }
    });



    // Smooth scroll para sidebar
    document.querySelectorAll('.profile-menu-item:not(.logout)').forEach(link => {
      link.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          document.querySelectorAll('.profile-menu-item').forEach(l => l.classList.remove('active'));
          this.classList.add('active');
        }
      });
    });
  </script>
</body>

</html>