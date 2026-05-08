// Carrito de compras con localStorage
const CART_KEY = 'truxup-cart';
const USER_KEY = 'truxup-user';
const DISCOUNT_MIN_QTY = 3;
const DISCOUNT_MIN_RATING = 4.5;
const DISCOUNT_PCT = 0.10;

function getCart() {
  try { return JSON.parse(localStorage.getItem(CART_KEY)) || []; }
  catch { return []; }
}

function saveCart(cart) {
  localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function hasQtyDiscount(item) {
  return item.qty >= DISCOUNT_MIN_QTY && parseFloat(item.rating) >= DISCOUNT_MIN_RATING;
}

function getUnitPrice(item) {
  return hasQtyDiscount(item) ? item.price * (1 - DISCOUNT_PCT) : item.price;
}

function getCartCount() {
  return getCart().reduce((s, i) => s + i.qty, 0);
}

function updateCartBadge() {
  const count = getCartCount();
  const badge = document.getElementById('cart-badge');
  if (!badge) return;
  badge.textContent = count;
  badge.style.display = count > 0 ? '' : 'none';
}

function addToCart(product) {
  const cart = getCart();
  const idx = cart.findIndex(i => i.id === product.id);
  if (idx >= 0) {
    cart[idx].qty++;
  } else {
    cart.push({ ...product, qty: 1 });
  }
  saveCart(cart);
  updateCartBadge();
  renderCartOffcanvas();
  showToast(`<strong>${product.name}</strong> añadido al carrito`, 'success');
}

function removeFromCart(id) {
  saveCart(getCart().filter(i => i.id !== id));
  updateCartBadge();
  renderCartOffcanvas();
  if (document.getElementById('cart-page-items')) renderCartPage();
  showToast('Producto eliminado del carrito', 'warning');
}

function updateQty(id, delta) {
  const cart = getCart();
  const idx = cart.findIndex(i => i.id === id);
  if (idx < 0) return;
  cart[idx].qty = Math.max(1, cart[idx].qty + delta);
  saveCart(cart);
  updateCartBadge();
  renderCartOffcanvas();
  if (document.getElementById('cart-page-items')) renderCartPage();
}

function renderCartOffcanvas() {
  const body = document.getElementById('cart-offcanvas-body');
  if (!body) return;
  const cart = getCart();

  if (cart.length === 0) {
    body.innerHTML = `
      <div class="text-center p-4 pt-5">
        <i class="fa-solid fa-cart-shopping fa-3x text-muted mb-3 d-block"></i>
        <p class="text-muted mb-3">Tu carrito está vacío</p>
        <button onclick="window.location.href='${window.BASE || ''}productos.html'" class="btn btn-primary btn-sm">Ver Productos</button>
      </div>`;
    return;
  }

  const total = cart.reduce((s, i) => s + getUnitPrice(i) * i.qty, 0);

  const itemsHtml = cart.map(item => {
    const disc = hasQtyDiscount(item);
    const unitP = getUnitPrice(item);
    return `
      <div class="cart-offcanvas-item d-flex gap-2 p-3 border-bottom">
        <img src="${item.image}" alt="${item.name}" style="width:65px;height:65px;object-fit:cover;border-radius:8px;flex-shrink:0;">
        <div class="flex-grow-1 overflow-hidden">
          <div class="fw-bold small text-truncate" style="color:var(--text-color);">${item.name}</div>
          <div class="small text-muted">${item.category}</div>
          <div class="d-flex align-items-center gap-1 mt-1">
            <button class="btn btn-sm btn-outline-secondary py-0 px-2 lh-1" onclick="updateQty('${item.id}',-1)">−</button>
            <span class="fw-bold px-1">${item.qty}</span>
            <button class="btn btn-sm btn-outline-secondary py-0 px-2 lh-1" onclick="updateQty('${item.id}',1)">+</button>
          </div>
          ${disc ? '<span class="badge-qty d-inline-block mt-1">10% dto. qty</span>' : ''}
        </div>
        <div class="text-end flex-shrink-0">
          <div class="fw-bold small text-danger">S/. ${(unitP * item.qty).toFixed(2)}</div>
          ${disc ? `<small class="text-muted text-decoration-line-through" style="font-size:0.7rem;">S/. ${(item.price * item.qty).toFixed(2)}</small>` : ''}
          <div><button class="btn btn-sm btn-outline-danger py-0 px-1 mt-1" onclick="removeFromCart('${item.id}')"><i class="fa-solid fa-trash" style="font-size:0.7rem;"></i></button></div>
        </div>
      </div>`;
  }).join('');

  const freeShippingThreshold = 500;
  const progress = Math.min((total / freeShippingThreshold) * 100, 100);
  const remaining = freeShippingThreshold - total;

  body.innerHTML = `
    <div class="p-3 border-bottom bg-light">
      <div class="d-flex justify-content-between mb-1">
        <small class="fw-bold">${total >= freeShippingThreshold ? '¡Envío Gratis alcanzado!' : `Faltan S/. ${remaining.toFixed(2)} para Envío Gratis`}</small>
        <small class="text-muted">${Math.round(progress)}%</small>
      </div>
      <div class="progress" style="height: 8px;">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: ${progress}%"></div>
      </div>
    </div>
    <div style="max-height:calc(100vh - 300px);overflow-y:auto;">${itemsHtml}</div>
    <div class="p-3 border-top mt-auto" style="background:var(--bg-card);">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="fw-bold text-muted">Subtotal:</span>
        <span class="fw-bold fs-5 text-primary">S/. ${total.toFixed(2)}</span>
      </div>
      <div class="row g-2">
        <div class="col-6">
          <button onclick="window.location.href='${window.BASE || ''}carrito.html'" class="btn btn-outline-primary w-100 py-2 fw-bold">
            <i class="fa-solid fa-cart-shopping me-1"></i>Ver más
          </button>
        </div>
        <div class="col-6">
          <button class="btn btn-primary w-100 py-2 fw-bold" onclick="proceedToCheckout()">
            <i class="fa-solid fa-lock me-1"></i>Pagar
          </button>
        </div>
      </div>
    </div>`;
}

function renderCartPage() {
  const container = document.getElementById('cart-page-items');
  const summary = document.getElementById('cart-page-summary');
  if (!container) return;
  const cart = getCart();

  const countEl = document.getElementById('cart-count-text');
  if (countEl) countEl.textContent = `${cart.length} producto${cart.length !== 1 ? 's' : ''} en tu carrito`;

  if (cart.length === 0) {
    container.innerHTML = `
      <div class="text-center py-5">
        <i class="fa-solid fa-cart-shopping fa-4x text-muted mb-4 d-block"></i>
        <h4 class="text-muted mb-3">Tu carrito está vacío</h4>
        <a href="${window.BASE || ''}productos.html" class="btn btn-primary px-4">Explorar Productos</a>
      </div>`;
    if (summary) summary.style.display = 'none';
    return;
  }
  if (summary) summary.style.display = '';

  const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
  const discount = cart.reduce((s, i) => s + (hasQtyDiscount(i) ? i.price * i.qty * DISCOUNT_PCT : 0), 0);
  const total = subtotal - discount;

  container.innerHTML = cart.map(item => {
    const disc = hasQtyDiscount(item);
    const unitP = getUnitPrice(item);
    return `
      <div class="cart-item-row d-flex gap-3 p-3 mb-3 rounded-3">
        <img src="${item.image}" alt="${item.name}" class="rounded-3" style="width:110px;height:110px;object-fit:cover;flex-shrink:0;">
        <div class="flex-grow-1">
          <h5 class="fw-bold mb-1" style="color:var(--text-color);">${item.name}</h5>
          <small class="text-muted">${item.category}</small>
          <div class="mt-1 fw-bold text-danger">
            S/. ${unitP.toFixed(2)}
            ${disc ? `<small class="text-muted text-decoration-line-through ms-1 fw-normal">S/. ${item.price.toFixed(2)}</small>` : ''}
          </div>
          ${disc ? '<span class="badge-qty d-inline-block mt-1">10% dto. por volumen</span>' : ''}
          <div class="d-flex align-items-center gap-2 mt-2">
            <button class="btn btn-sm btn-outline-secondary" onclick="updateQty('${item.id}',-1)">−</button>
            <span class="fw-bold px-2">${item.qty}</span>
            <button class="btn btn-sm btn-outline-secondary" onclick="updateQty('${item.id}',1)">+</button>
          </div>
        </div>
        <div class="text-end flex-shrink-0">
          <div class="fw-bold fs-5 mb-2" style="color:var(--text-color);">S/. ${(unitP * item.qty).toFixed(2)}</div>
          <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart('${item.id}')">
            <i class="fa-solid fa-trash me-1"></i>Eliminar
          </button>
        </div>
      </div>`;
  }).join('');

  if (summary) {
    summary.innerHTML = `
      <h5 class="fw-bold mb-4 pb-3 border-bottom" style="color:var(--trux-dark);">
        <i class="fa-solid fa-receipt me-2" style="color:var(--trux-primary);"></i>Resumen del Pedido
      </h5>
      <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span class="fw-bold">S/. ${subtotal.toFixed(2)}</span></div>
      ${discount > 0 ? `<div class="d-flex justify-content-between mb-2"><span class="text-muted">Descuento qty</span><span class="fw-bold text-success">-S/. ${discount.toFixed(2)}</span></div>` : ''}
      <div class="d-flex justify-content-between mb-2"><span class="text-muted">Envío</span><span class="fw-bold text-primary">Gratis</span></div>
      <hr>
      <div class="d-flex justify-content-between mb-4">
        <strong class="fs-5">Total</strong>
        <strong class="fs-4" style="color:var(--trux-primary);">S/. ${total.toFixed(2)}</strong>
      </div>
      <button class="btn btn-primary w-100 py-3 fw-bold mb-2" onclick="proceedToCheckout()">
        <i class="fa-solid fa-lock me-2"></i>Proceder al Pago
      </button>
      <a href="${window.BASE || ''}productos.html" class="btn btn-outline-primary w-100 py-2 fw-bold">
        <i class="fa-solid fa-arrow-left me-2"></i>Seguir Comprando
      </a>
      <div class="text-center mt-3">
        <small class="text-muted"><i class="fa-solid fa-lock me-1 text-success"></i>Pago 100% seguro</small>
      </div>
      <div class="d-flex justify-content-center gap-3 mt-2">
        <i class="fa-brands fa-cc-visa fa-2x" style="color:var(--trux-primary);"></i>
        <i class="fa-brands fa-cc-mastercard fa-2x" style="color:var(--trux-primary);"></i>
        <i class="fa-brands fa-paypal fa-2x" style="color:var(--trux-primary);"></i>
      </div>`;
  }
}

function proceedToCheckout() {
  if (!localStorage.getItem(USER_KEY)) {
    showToast('Debes <a href="login.html" class="alert-link text-white fw-bold">iniciar sesión</a> para proceder al pago', 'info', 5000);
    return;
  }
  if (getCartCount() === 0) {
    showToast('Tu carrito está vacío', 'warning');
    return;
  }
  window.location.href = (window.BASE || '') + 'pago.html';
}

function openBundleModal(products) {
  const modal = document.getElementById('bundleModal');
  if (!modal) return;
  document.getElementById('bundle-modal-body').innerHTML = `
    <p class="text-muted mb-3">Añade este bundle completo a tu carrito de una sola vez:</p>
    ${products.map(p => `
      <div class="d-flex gap-3 align-items-center mb-3 p-2 border rounded">
        <img src="${p.image}" alt="${p.name}" style="width:55px;height:55px;object-fit:cover;border-radius:6px;">
        <div class="flex-grow-1">
          <div class="fw-bold small" style="color:var(--trux-dark);">${p.name}</div>
          <div style="color:var(--trux-danger);font-weight:bold;">S/. ${p.price.toFixed(2)}</div>
        </div>
      </div>`).join('')}
    <div class="text-center p-3 rounded mt-2" style="background:var(--bg-color);">
      <strong>Total del bundle: </strong>
      <span style="color:var(--trux-primary);font-size:1.2rem;font-weight:bold;">
        S/. ${products.reduce((s, p) => s + p.price, 0).toFixed(2)}
      </span>
    </div>`;
  document.getElementById('confirm-bundle').onclick = () => {
    products.forEach(p => {
      const cart = getCart();
      const idx = cart.findIndex(i => i.id === p.id);
      if (idx >= 0) cart[idx].qty++;
      else cart.push({ ...p, qty: 1 });
      saveCart(cart);
    });
    updateCartBadge();
    renderCartOffcanvas();
    bootstrap.Modal.getInstance(modal).hide();
    showToast(`${products.length} productos del bundle añadidos al carrito`, 'success');
  };
  new bootstrap.Modal(modal).show();
}

document.addEventListener('DOMContentLoaded', function () {
  updateCartBadge();
  renderCartOffcanvas();
  if (document.getElementById('cart-page-items')) renderCartPage();

  // Delegar click en botones "Agregar al carrito"
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-add-to-cart]');
    if (!btn) return;
    const card = btn.closest('[data-product-id]');
    if (!card) return;
    addToCart({
      id: card.dataset.productId,
      name: card.dataset.productName,
      price: parseFloat(card.dataset.productPrice),
      image: card.dataset.productImage,
      category: card.dataset.productCategory,
      rating: parseFloat(card.dataset.productRating) || 0
    });
  });

  // Botones de bundle
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-bundle]');
    if (!btn) return;
    try { openBundleModal(JSON.parse(btn.dataset.bundle)); } catch {}
  });
});


