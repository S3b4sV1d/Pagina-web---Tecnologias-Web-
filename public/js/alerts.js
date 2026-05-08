// Sistema de alertas Toast
function showToast(message, type = 'success', duration = 3500) {
  const container = document.getElementById('toast-container');
  if (!container) return;
  const icons = {
    success: 'fa-circle-check',
    warning: 'fa-triangle-exclamation',
    danger: 'fa-circle-xmark',
    info: 'fa-circle-info'
  };
  const id = 'toast-' + Date.now();
  container.insertAdjacentHTML('beforeend', `
    <div id="${id}" class="toast align-items-center text-bg-${type} border-0 mb-2" role="alert" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="fa-solid ${icons[type] || 'fa-circle-info'} me-2"></i>${message}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>`);
  const el = document.getElementById(id);
  const t = new bootstrap.Toast(el, { delay: duration });
  t.show();
  el.addEventListener('hidden.bs.toast', () => el.remove());
}

function showConfirm(title, message, onConfirm) {
  const id = 'confirm-' + Date.now();
  const html = `
    <div class="modal fade" id="${id}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header border-bottom-0 pb-0">
            <h5 class="modal-title fw-bold"><i class="fa-solid fa-circle-question text-primary me-2"></i>${title}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body py-3">
            <p class="mb-0 text-muted">${message}</p>
          </div>
          <div class="modal-footer border-top-0 pt-0">
            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary px-4" id="${id}-btn">Confirmar</button>
          </div>
        </div>
      </div>
    </div>`;

  document.body.insertAdjacentHTML('beforeend', html);
  const el = document.getElementById(id);
  const m = new bootstrap.Modal(el);
  
  document.getElementById(`${id}-btn`).onclick = () => {
    onConfirm();
    m.hide();
  };
  
  el.addEventListener('hidden.bs.toast', () => el.remove());
  m.show();
}

