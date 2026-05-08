<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finalizar Compra | Trux-up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/estilos.css">
  <script src="https://kit.fontawesome.com/4df0087ba8.js" crossorigin="anonymous"></script>
  <script>window.BASE_URL = './';</script>
  <script type="module" src="js/layout.js"></script>
  <style>
    .payment-card {
      border: 2px solid var(--border-color);
      border-radius: 12px;
      padding: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: var(--bg-card);
    }
    .payment-card:hover { border-color: var(--trux-primary); transform: translateY(-2px); }
    .payment-card.active { border-color: var(--trux-primary); background: rgba(0, 86, 255, 0.05); }
    .payment-card i { font-size: 1.5rem; color: var(--trux-primary); }
    .order-summary-box {
      position: sticky;
      top: 100px;
      background: var(--bg-card);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      box-shadow: var(--shadow);
    }
  </style>
</head>
<body>

<div id="global-header"></div>

<section style="padding: 60px 0; background: var(--bg-color); min-height: 80vh;">
  <div class="container">
    <div class="row g-4">
      <!-- Columna Izquierda: Pago -->
      <div class="col-lg-8">
        <div class="p-4 rounded-3 mb-4 shadow-sm" style="background: var(--bg-card); border: 1px solid var(--border-color);">
          <h4 class="fw-bold mb-4"><i class="fa-solid fa-credit-card me-2 text-primary"></i>Método de Pago</h4>
          
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <div class="payment-card active d-flex align-items-center gap-3" onclick="selectPayment(this)">
                <i class="fa-solid fa-credit-card"></i>
                <div>
                  <div class="fw-bold">Tarjeta de Crédito/Débito</div>
                  <small class="text-muted">Visa, Mastercard, AMEX</small>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="payment-card d-flex align-items-center gap-3" onclick="selectPayment(this)">
                <i class="fa-brands fa-paypal"></i>
                <div>
                  <div class="fw-bold">PayPal</div>
                  <small class="text-muted">Paga con tu cuenta PayPal</small>
                </div>
              </div>
            </div>
          </div>

          <form id="payment-details-form">
            <div class="mb-3">
              <label class="form-label fw-bold">Nombre en la Tarjeta</label>
              <input type="text" class="form-control" placeholder="Juan Pérez" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Número de Tarjeta</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock text-muted"></i></span>
                <input type="text" class="form-control" placeholder="0000 0000 0000 0000" maxlength="19" required>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-bold">Fecha de Expiración</label>
                <input type="text" class="form-control" placeholder="MM/YY" maxlength="5" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">CVC / CVV</label>
                <input type="password" class="form-control" placeholder="123" maxlength="3" required>
              </div>
            </div>
          </form>

          <!-- Formulario PayPal (Oculto por defecto) -->
          <form id="paypal-details-form" style="display: none;">
            <div class="p-3 rounded bg-light border">
              <div class="mb-3">
                <label class="form-label fw-bold"><i class="fa-solid fa-envelope me-2 text-primary"></i>Correo de Cuenta PayPal</label>
                <input type="email" class="form-control" placeholder="usuario@paypal.com" required>
              </div>
              <p class="small text-muted mb-0"><i class="fa-solid fa-circle-info me-1"></i>Serás redirigido para confirmar la transacción de forma segura.</p>
            </div>
          </form>
        </div>

        <div class="p-4 rounded-3 shadow-sm" style="background: var(--bg-card); border: 1px solid var(--border-color);">
          <h4 class="fw-bold mb-4"><i class="fa-solid fa-truck me-2 text-primary"></i>Confirmar Dirección</h4>
          <div id="checkout-address-display" class="p-3 rounded border bg-light text-dark fw-bold">
            Cargando dirección...
          </div>
        </div>
      </div>

      <!-- Columna Derecha: Resumen -->
      <div class="col-lg-4">
        <div class="order-summary-box p-4">
          <h5 class="fw-bold mb-4 border-bottom pb-2">Resumen de Orden</h5>
          <div id="checkout-items" class="mb-4" style="max-height: 300px; overflow-y: auto;">
            <!-- Items del carrito se cargan aquí -->
          </div>
          
          <div class="d-flex justify-content-between mb-2">
            <span>Subtotal</span>
            <span id="checkout-subtotal">S/. 0.00</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span>Envío</span>
            <span class="text-success fw-bold">Gratis</span>
          </div>
          <hr>
          <div class="d-flex justify-content-between mb-4">
            <span class="h5 fw-bold">Total</span>
            <span class="h5 fw-bold text-primary" id="checkout-total">S/. 0.00</span>
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="terms-pago" required>
            <label class="form-check-label small text-muted" for="terms-pago">
              Acepto los términos de servicio y políticas de reembolso de Trux-up.
            </label>
          </div>

          <button class="btn btn-primary w-100 py-3 fw-bold shadow" onclick="confirmPurchase()">
            <i class="fa-solid fa-shield-check me-2"></i>FINALIZAR COMPRA
          </button>
          
          <div class="text-center mt-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" height="15" class="mx-1 opacity-50">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" height="15" class="mx-1 opacity-50">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="global-footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/alerts.js"></script>
<script type="module">
import { checkAuth } from './js/auth.js';

document.addEventListener('DOMContentLoaded', async () => {
  const user = await checkAuth();
  if (!user) {
    window.location.href = 'login.html';
    return;
  }

  document.getElementById('checkout-address-display').innerHTML = `
    <i class="fa-solid fa-location-dot me-2 text-primary"></i>
    ${user.address}, ${user.city}
  `;

  renderSummary();
});

function renderSummary() {
  const cart = JSON.parse(localStorage.getItem('truxup-cart') || '[]');
  const container = document.getElementById('checkout-items');
  let total = 0;

  if (!cart.length) {
    window.location.href = 'productos.html';
    return;
  }

  container.innerHTML = cart.map(item => {
    total += item.price * item.qty;
    return `
      <div class="d-flex align-items-center gap-3 mb-3">
        <img src="${item.image}" width="50" height="50" class="rounded border" style="object-fit:cover;">
        <div class="flex-grow-1">
          <div class="small fw-bold text-truncate" style="max-width:150px;">${item.name}</div>
          <div class="small text-muted">${item.qty} x S/. ${item.price}</div>
        </div>
        <div class="fw-bold small">S/. ${(item.price * item.qty).toFixed(2)}</div>
      </div>
    `;
  }).join('');

  document.getElementById('checkout-subtotal').textContent = `S/. ${total.toFixed(2)}`;
  document.getElementById('checkout-total').textContent = `S/. ${total.toFixed(2)}`;
}

window.confirmPurchase = async function() {
  const isCard = document.querySelector('.payment-card:first-child').classList.contains('active');
  const cardForm = document.getElementById('payment-details-form');
  const paypalForm = document.getElementById('paypal-details-form');
  
  if (isCard) {
    if (!cardForm.checkValidity()) {
      cardForm.reportValidity();
      showToast('Por favor, completa los datos de la tarjeta', 'warning');
      return;
    }
  } else {
    if (!paypalForm.checkValidity()) {
      paypalForm.reportValidity();
      showToast('Por favor, ingresa tu correo de PayPal', 'warning');
      return;
    }
    showToast('Validando cuenta PayPal...', 'info');
  }

  // Validar términos
  if (!document.getElementById('terms-pago').checked) {
    showToast('Debes aceptar los términos y condiciones', 'warning');
    return;
  }

  const cart = JSON.parse(localStorage.getItem('truxup-cart') || '[]');
  const total = cart.reduce((s, i) => s + i.price * i.qty, 0);

  try {
    const response = await fetch('php/api.php?action=save_order', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ total })
    });
    const result = await response.json();

    if (result.success) {
      localStorage.removeItem('truxup-cart');
      showToast('¡Compra realizada con éxito!', 'success');
      setTimeout(() => window.location.href = `confirmacion.html?id=${result.order_id}`, 1000);
    } else {
      showToast(result.message, 'danger');
    }
  } catch (err) {
    showToast('Error de conexión', 'danger');
  }
}

window.selectPayment = function(el) {
  document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('active'));
  el.classList.add('active');
  
  const cardForm = document.getElementById('payment-details-form');
  const paypalForm = document.getElementById('paypal-details-form');
  const isCard = el.querySelector('.fa-credit-card');
  
  if (isCard) {
    cardForm.style.display = 'block';
    paypalForm.style.display = 'none';
  } else {
    cardForm.style.display = 'none';
    paypalForm.style.display = 'block';
    showToast('Método PayPal seleccionado', 'info');
  }
}
</script>
</body>
</html>
