/**
 * Products Module - Handles fetching and rendering products from the DB
 */

export async function fetchProducts() {
    try {
        const response = await fetch('php/index.php?action=get_products');
        return await response.json();
    } catch (err) {
        console.error('Error fetching products:', err);
        return [];
    }
}

export function renderProductCard(product) {
    const isDiscounted = product.price < 50; // Mock logic for discount badge
    const badgeHtml = isDiscounted ? `<div class="producto-badge">Oferta</div>` : '';
    
    return `
    <div class="product-col col-xl-4 col-md-6 col-6" data-product-category="${product.category}">
      <div class="card producto-card h-100" 
           data-product-id="${product.id}" 
           data-product-name="${product.name}" 
           data-product-price="${product.price}" 
           data-product-image="${product.image}" 
           data-product-category="${product.category}" 
           data-product-rating="${product.rating}">
        ${badgeHtml}
        <img loading="lazy" src="${product.image}" class="card-img-top" alt="${product.name}">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-1">
            <div class="rating-stars">
              ${generateStars(product.rating)}
              <span class="rating-text">(${product.rating})</span>
            </div>
            <button class="btn-rate-product" onclick="openRatingModal('${product.id}','${product.name}')">Calificar</button>
          </div>
          <h5 class="card-title">${product.name}</h5>
          <p class="card-text flex-grow-1">${product.description || ''}</p>
          <p class="precio">S/. ${product.price}</p>
          <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
        </div>
      </div>
    </div>`;
}

function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= Math.floor(rating)) {
            stars += '<i class="fa-solid fa-star"></i>';
        } else if (i - 0.5 <= rating) {
            stars += '<i class="fa-solid fa-star-half-stroke"></i>';
        } else {
            stars += '<i class="fa-regular fa-star"></i>';
        }
    }
    return stars;
}

export function initProductsGrid(containerId, products) {
    const container = document.getElementById(containerId);
    if (!container) return;

    // Group by category if we want to maintain the sectioned look
    const categories = [...new Set(products.map(p => p.category))];
    
    container.innerHTML = categories.map(cat => `
        <div class="category-section" id="cat-${cat.toLowerCase().replace(/\s+/g, '-')}">
            <h2 class="category-header"><i class="fa-solid fa-tag me-2" style="color:var(--trux-primary);"></i>${cat}</h2>
            <div class="row g-4 mb-2">
                ${products.filter(p => p.category === cat).map(p => renderProductCard(p)).join('')}
            </div>
            <p class="cat-empty-msg text-muted text-center py-3" style="display:none;">No hay productos que coincidan.</p>
        </div>
    `).join('');
}

