// Sistema de calificación de productos
const RATINGS_KEY = 'truxup-ratings';

function getRatings() {
  try { return JSON.parse(localStorage.getItem(RATINGS_KEY)) || {}; }
  catch { return {}; }
}

function starsHtmlFromRating(rating) {
  let html = '';
  for (let i = 1; i <= 5; i++) {
    if (i <= Math.floor(rating)) html += '<i class="fa-solid fa-star"></i>';
    else if (rating >= i - 0.5) html += '<i class="fa-solid fa-star-half-stroke"></i>';
    else html += '<i class="fa-regular fa-star"></i>';
  }
  return html;
}

function openRatingModal(productId, productName) {
  if (!localStorage.getItem('truxup-user')) {
    showToast('Debes <a href="login.html" class="alert-link text-white fw-bold">iniciar sesión</a> para calificar', 'info', 4500);
    return;
  }
  document.getElementById('rating-product-name').textContent = productName;
  document.getElementById('rating-product-id').value = productId;
  document.getElementById('rating-value').value = '0';
  document.getElementById('rating-comment').value = '';
  document.querySelectorAll('.star-input').forEach(s => s.className = 'fa-regular fa-star star-input');
  new bootstrap.Modal(document.getElementById('ratingModal')).show();
}

document.addEventListener('DOMContentLoaded', function () {
  const starsContainer = document.getElementById('rating-stars-input');
  if (starsContainer) {
    starsContainer.addEventListener('mouseover', function (e) {
      const star = e.target.closest('.star-input');
      if (!star) return;
      const val = parseInt(star.dataset.value);
      starsContainer.querySelectorAll('.star-input').forEach((s, i) => {
        s.className = (i < val ? 'fa-solid' : 'fa-regular') + ' fa-star star-input';
      });
    });
    starsContainer.addEventListener('mouseleave', function () {
      const selected = parseInt(document.getElementById('rating-value').value) || 0;
      starsContainer.querySelectorAll('.star-input').forEach((s, i) => {
        s.className = (i < selected ? 'fa-solid' : 'fa-regular') + ' fa-star star-input';
      });
    });
    starsContainer.addEventListener('click', function (e) {
      const star = e.target.closest('.star-input');
      if (!star) return;
      const val = parseInt(star.dataset.value);
      document.getElementById('rating-value').value = val;
      starsContainer.querySelectorAll('.star-input').forEach((s, i) => {
        s.className = (i < val ? 'fa-solid' : 'fa-regular') + ' fa-star star-input';
      });
    });
  }

  const submitBtn = document.getElementById('submit-rating');
  if (submitBtn) {
    submitBtn.addEventListener('click', function () {
      const productId = document.getElementById('rating-product-id').value;
      const val = parseInt(document.getElementById('rating-value').value);
      if (!val) { showToast('Selecciona una puntuación', 'warning'); return; }

      const ratings = getRatings();
      if (!ratings[productId]) ratings[productId] = { total: 0, count: 0, avg: 0 };
      ratings[productId].total += val;
      ratings[productId].count++;
      ratings[productId].avg = parseFloat((ratings[productId].total / ratings[productId].count).toFixed(1));
      localStorage.setItem(RATINGS_KEY, JSON.stringify(ratings));

      // Actualizar visual en la card
      const card = document.querySelector(`[data-product-id="${productId}"]`);
      if (card) {
        const starsEl = card.querySelector('.rating-stars');
        const textEl = card.querySelector('.rating-text');
        if (starsEl) starsEl.innerHTML = starsHtmlFromRating(ratings[productId].avg);
        if (textEl) textEl.textContent = `(${ratings[productId].avg})`;
        card.dataset.productRating = ratings[productId].avg;
        // Actualizar en carrito si está
        try {
          const cart = getCart();
          const idx = cart.findIndex(i => i.id === productId);
          if (idx >= 0) { cart[idx].rating = ratings[productId].avg; saveCart(cart); updateCartBadge(); renderCartOffcanvas(); }
        } catch {}
      }

      bootstrap.Modal.getInstance(document.getElementById('ratingModal')).hide();
      showToast(`¡Gracias! Calificaste con ${val} ${val === 1 ? 'estrella' : 'estrellas'}`, 'success');
    });
  }

  // Cargar ratings guardados al iniciar
  const ratings = getRatings();
  document.querySelectorAll('[data-product-id]').forEach(card => {
    const id = card.dataset.productId;
    if (ratings[id]) {
      const starsEl = card.querySelector('.rating-stars');
      const textEl = card.querySelector('.rating-text');
      if (starsEl) starsEl.innerHTML = starsHtmlFromRating(ratings[id].avg);
      if (textEl) textEl.textContent = `(${ratings[id].avg})`;
      card.dataset.productRating = ratings[id].avg;
    }
  });
});

