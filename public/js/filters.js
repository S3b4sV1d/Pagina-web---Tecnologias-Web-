// Sistema de filtros para index y productos
document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('[data-filter-cat]')) {
    initIndexFilters();
  }
  if (document.getElementById('products-catalog-container')) {
    initProductFilters();
  }
});

// Index: filtro por tabs de categoría en productos destacados
function initIndexFilters() {
  const tabBtns = document.querySelectorAll('[data-filter-cat]');
  if (!tabBtns.length) return;

  tabBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      tabBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      const cat = this.dataset.filterCat;
      document.querySelectorAll('.featured-product-item').forEach(item => {
        const show = cat === 'todos' || item.dataset.productCategory === cat;
        item.style.display = show ? '' : 'none';
      });
    });
  });
}

// Productos: filtros de sidebar (categoría, precio, rating, descuento, ordenar, búsqueda)
let productFiltersInitialized = false;

function initProductFilters() {
  // Evitar doble inicialización pero permitir re-aplicar filtros si es necesario
  const container = document.getElementById('products-catalog-container');
  if (!container) return;

  const getElements = (id) => [document.getElementById(id), document.getElementById('mobile-' + id)].filter(el => el !== null);

  const searchInputs   = getElements('product-search');
  const catFilters     = getElements('filter-category');
  const priceMinInputs = getElements('filter-price-min');
  const priceMaxInputs = getElements('filter-price-max');
  const ratingFilters  = getElements('filter-rating');
  const sortSels       = getElements('filter-sort');
  const resetBtns      = getElements('reset-filters');

  // 1. Cargar valores iniciales desde URL (solo la primera vez o si se llama explícitamente)
  const params = new URLSearchParams(window.location.search);
  const urlSearch = params.get('search');
  const urlCat = params.get('category');

  if (urlSearch) {
    searchInputs.forEach(i => i.value = urlSearch);
  }
  
  if (urlCat) {
    catFilters.forEach(sel => {
      for (let opt of sel.options) {
        if (opt.value.toLowerCase() === urlCat.toLowerCase() || opt.text.toLowerCase() === urlCat.toLowerCase()) {
          sel.value = opt.value;
          break;
        }
      }
    });
  }

  // 2. Definir función de filtrado
  const applyFilters = (e) => {
    // Sincronizar valores entre desktop y mobile si el evento viene de uno de ellos
    if (e && e.target) {
      const val = e.target.type === 'checkbox' ? e.target.checked : e.target.value;
      const isMobile = e.target.id && e.target.id.startsWith('mobile-');
      const baseId = isMobile ? e.target.id.replace('mobile-', '') : e.target.id;
      const otherId = isMobile ? baseId : 'mobile-' + baseId;
      const otherEl = document.getElementById(otherId);
      if (otherEl) {
        if (e.target.type === 'checkbox') otherEl.checked = val;
        else otherEl.value = val;
      }
    }

    // Obtener valores actuales (priorizando desktop si ambos existen y están sincronizados)
    const search = (searchInputs[0]?.value || '').toLowerCase().trim();
    const cat    = catFilters[0]?.value || 'todos';
    const minP   = parseFloat(priceMinInputs[0]?.value) || 0;
    const maxP   = parseFloat(priceMaxInputs[0]?.value) || Infinity;
    const minR   = parseFloat(ratingFilters[0]?.value) || 0;

    let visible = [];
    const cards = document.querySelectorAll('[data-product-id]');
    
    if (cards.length === 0) {
      // Si no hay productos aún, reintentar en un momento si venimos de URL
      if (!e && (urlSearch || urlCat)) {
        setTimeout(() => applyFilters(), 200);
      }
      return;
    }

    cards.forEach(card => {
      const name    = (card.dataset.productName     || '').toLowerCase();
      const cardCat = (card.dataset.productCategory || '');
      const price   = parseFloat(card.dataset.productPrice)  || 0;
      const rating  = parseFloat(card.dataset.productRating) || 0;

      const matchesSearch = !search || name.includes(search);
      const matchesCat    = cat === 'todos' || cardCat === cat;
      const matchesPrice  = price >= minP && price <= maxP;
      const matchesRating = rating >= minR;

      const ok = matchesSearch && matchesCat && matchesPrice && matchesRating;

      const col = card.closest('.product-col');
      if (col) {
        col.style.display = ok ? '' : 'none';
        if (ok) visible.push({ el: col, price, rating, name });
      }
    });

    // Manejo de secciones y mensajes
    const sections = document.querySelectorAll('.category-section');
    sections.forEach(sec => {
      const allCols = sec.querySelectorAll('.product-col');
      const visibleInSec = Array.from(allCols).filter(c => c.style.display !== 'none');
      
      const secCatTitle = sec.querySelector('.category-header')?.textContent.trim() || '';
      const isFilteredCat = cat !== 'todos' && (sec.id.includes(cat.toLowerCase().replace(/\s+/g, '-')) || secCatTitle === cat);
      
      // Si la categoría está específicamente filtrada, mostrar siempre la sección (con o sin productos)
      if (cat !== 'todos') {
        sec.style.display = isFilteredCat ? '' : 'none';
      } else {
        // Si estamos en "todos", solo mostrar secciones que tengan al menos un producto visible
        sec.style.display = visibleInSec.length > 0 ? '' : 'none';
      }

      const emptyMsg = sec.querySelector('.cat-empty-msg');
      if (emptyMsg) {
        emptyMsg.style.display = (sec.style.display === '' && visibleInSec.length === 0) ? '' : 'none';
      }
    });

    // Mostrar/ocultar mensaje global de no resultados
    const noResults = document.getElementById('no-results');
    if (noResults) {
      noResults.classList.toggle('d-none', visible.length > 0);
    }

    // Ordenar si es necesario
    const sortSel = sortSels[0];
    if (sortSel && visible.length > 1) {
      const val = sortSel.value;
      if (val !== 'default') {
        const parent = visible[0].el.parentElement;
        visible.sort((a, b) => {
          if (val === 'price-asc')  return a.price  - b.price;
          if (val === 'price-desc') return b.price  - a.price;
          if (val === 'rating')     return b.rating - a.rating;
          if (val === 'name')       return a.name.localeCompare(b.name);
          return 0;
        });
        visible.forEach(v => parent.appendChild(v.el));
      }
    }
  };

  // 3. Registrar eventos solo una vez
  if (!productFiltersInitialized) {
    const allControls = [...searchInputs, ...catFilters, ...priceMinInputs, ...priceMaxInputs, ...ratingFilters, ...sortSels];
    allControls.forEach(el => {
      const eventType = (el.tagName === 'SELECT') ? 'change' : 'input';
      el.addEventListener(eventType, applyFilters);
    });

    resetBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        [...searchInputs, ...priceMinInputs, ...priceMaxInputs].forEach(i => i.value = '');
        catFilters.forEach(i => i.value = 'todos');
        ratingFilters.forEach(i => i.value = '0');
        sortSels.forEach(i => i.value = 'default');
        applyFilters();
      });
    });

    productFiltersInitialized = true;
  }

  // 4. Aplicar filtros iniciales
  applyFilters();
}

// Hacerlo disponible globalmente
window.initProductFilters = initProductFilters;


