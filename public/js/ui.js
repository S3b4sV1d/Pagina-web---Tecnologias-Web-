import { logout } from './auth.js';

export const initUI = () => {
    _registerEventListeners();
    _listenAppEvents();
};

const _registerEventListeners = () => {
    // Delegación de eventos global
    document.addEventListener('click', (e) => {
        // Toggle Modo Oscuro
        if (e.target.closest('#darkmode-toggle')) {
            _toggleTheme();
        }

        // Logout (Header, Perfil, Admin)
        if (e.target.closest('.logout-btn') || e.target.closest('.logout')) {
            e.preventDefault();
            
            if (window.showConfirm) {
                window.showConfirm(
                    'Cerrar Sesión', 
                    '¿Estás seguro de que deseas cerrar la sesión actual?', 
                    () => document.dispatchEvent(new CustomEvent('app:logout'))
                );
            } else if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                document.dispatchEvent(new CustomEvent('app:logout'));
            }
        }

        // Delegar a cart.js u otros si es necesario (ej: añadir al carrito)
        const addBtn = e.target.closest('[data-add-to-cart]');
        if (addBtn) {
            // El componente cart.js ya escucha esto por delegación en su propio archivo, 
            // pero podríamos centralizarlo aquí disparando un evento.
        }
        // Búsqueda Global
        if (e.target.closest('#btn-global-search')) {
            _handleGlobalSearch();
        }

        // Abrir Detalle de Producto
        const detailTrigger = e.target.closest('.card-img-top') || e.target.closest('.card-title');
        if (detailTrigger) {
            const card = detailTrigger.closest('[data-product-id]');
            if (card && !e.target.closest('button')) {
                _openProductDetail(card.dataset);
            }
        }
    });

    // Enter en búsqueda global
    document.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && e.target.id === 'global-search') {
            _handleGlobalSearch();
        }
    });
};

const _handleGlobalSearch = () => {
    const input = document.getElementById('global-search');
    if (!input) return;
    const term = input.value.trim();
    if (term) {
        window.location.href = (window.BASE || '') + `productos.html?search=${encodeURIComponent(term)}`;
    }
};


const _openProductDetail = (data) => {
    const modal = document.getElementById('productDetailModal');
    if (!modal) return;

    document.getElementById('detail-img').src = data.productImage;
    document.getElementById('detail-name').textContent = data.productName;
    document.getElementById('detail-cat').textContent = data.productCategory;
    document.getElementById('detail-price').textContent = `S/. ${data.productPrice}`;
    document.getElementById('detail-rating').textContent = `(${data.productRating})`;
    document.getElementById('detail-desc').textContent = data.productName + " es un producto premium de nuestra categoría " + data.productCategory + ". Ofrece la mejor relación calidad-precio y garantía Trux-up.";
    
    // Estrellas
    const stars = document.getElementById('detail-stars');
    const r = parseFloat(data.productRating);
    stars.innerHTML = '<i class="fa-solid fa-star"></i>'.repeat(Math.floor(r)) + 
                      (r % 1 >= 0.5 ? '<i class="fa-solid fa-star-half-stroke"></i>' : '') +
                      '<i class="fa-regular fa-star"></i>'.repeat(5 - Math.ceil(r));
    
    const addBtn = document.getElementById('detail-add-btn');
    addBtn.onclick = () => {
        // Disparar evento para que cart.js lo capture
        const btn = document.querySelector(`[data-product-id="${data.productId}"] [data-add-to-cart]`);
        if (btn) btn.click();
        bootstrap.Modal.getInstance(modal).hide();
    };

    new bootstrap.Modal(modal).show();
};

const _listenAppEvents = () => {
    // Escuchar cambios de autenticación
    document.addEventListener('app:auth-changed', (e) => {
        const { user, loggedIn } = e.detail;
        _updateAuthUI(user, loggedIn);
    });

    // Escuchar solicitudes de logout desde UI
    // Esto se maneja centralmente en layout.js o admin.js
    // document.addEventListener('app:logout', () => { ... });
};

const _updateAuthUI = (user, loggedIn) => {
    const guestElements = document.querySelectorAll('.auth-guest');
    const userElements = document.querySelectorAll('.auth-user');
    const adminElements = document.querySelectorAll('.auth-admin');

    if (loggedIn) {
        guestElements.forEach(el => el.classList.add('d-none'));
        userElements.forEach(el => el.classList.remove('d-none'));
        
        // Mostrar panel admin solo si es rol admin
        if (user && user.role === 'admin') {
            adminElements.forEach(el => el.classList.remove('d-none'));
        } else {
            adminElements.forEach(el => el.classList.add('d-none'));
        }

        const nameEl = document.getElementById('nav-user-name');
        if (nameEl) nameEl.textContent = user.name;
    } else {
        guestElements.forEach(el => el.classList.remove('d-none'));
        userElements.forEach(el => el.classList.add('d-none'));
        adminElements.forEach(el => el.classList.add('d-none'));
    }
};

const _toggleTheme = () => {
    const current = document.documentElement.getAttribute('data-theme') || 'light';
    const next = current === 'dark' ? 'light' : 'dark';
    
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('truxup-theme', next);
    
    _updateThemeIcon(next);
};

export const _updateThemeIcon = (theme) => {
    const btn = document.getElementById('darkmode-toggle');
    if (!btn) return;
    
    btn.innerHTML = theme === 'dark' ? '<i class="fa-solid fa-sun fs-5"></i>' : '<i class="fa-solid fa-moon fs-5"></i>';
    btn.title = theme === 'dark' ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro';
};

