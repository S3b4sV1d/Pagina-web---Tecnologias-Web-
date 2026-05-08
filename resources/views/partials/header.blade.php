
   
    <div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index:1100; margin-top: 70px;"></div>


    <div class="modal fade" id="ratingModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header navbar-truxup">
            <h5 class="modal-title text-white"><i class="fa-solid fa-star me-2"></i>Calificar Producto</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body text-center py-4">
            <h6 id="rating-product-name" class="mb-4 fw-bold"></h6>
            <div id="rating-stars-input" class="mb-3 d-flex justify-content-center gap-1">
              <i class="fa-regular fa-star star-input" data-value="1"></i>
              <i class="fa-regular fa-star star-input" data-value="2"></i>
              <i class="fa-regular fa-star star-input" data-value="3"></i>
              <i class="fa-regular fa-star star-input" data-value="4"></i>
              <i class="fa-regular fa-star star-input" data-value="5"></i>
            </div>
            <input type="hidden" id="rating-value" value="0">
            <input type="hidden" id="rating-product-id" value="">
            <textarea class="form-control" id="rating-comment" placeholder="Comentario opcional..." rows="3"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="submit-rating"><i class="fa-solid fa-check me-1"></i>Calificar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="productDetailModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:15px; overflow:hidden;">
          <div class="modal-body p-0">
            <div class="row g-0">
              <div class="col-md-6">
                <img id="detail-img" src="" class="img-fluid h-100" style="object-fit:cover;">
              </div>
              <div class="col-md-6 p-4">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                <div class="mb-2"><span id="detail-cat" class="badge bg-primary-subtle text-primary text-uppercase" style="font-size:0.7rem;letter-spacing:1px;"></span></div>
                <h3 id="detail-name" class="fw-bold mb-3" style="color:var(--trux-dark);"></h3>
                <div class="d-flex align-items-center gap-2 mb-3">
                  <div id="detail-stars" class="text-warning"></div>
                  <span id="detail-rating" class="text-muted small"></span>
                </div>
                <p id="detail-desc" class="text-muted mb-4"></p>
                <div class="fs-2 fw-bold text-primary mb-4" id="detail-price"></div>
                <div class="d-grid gap-2">
                  <button class="btn btn-primary btn-lg fw-bold py-3" id="detail-add-btn">
                    <i class="fa-solid fa-cart-plus me-2"></i>Agregar al Carrito
                  </button>
                  <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Seguir Explorando</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="bundleModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header navbar-truxup">
            <h5 class="modal-title text-white"><i class="fa-solid fa-tags me-2"></i>Oferta Bundle</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" id="bundle-modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="confirm-bundle"><i class="fa-solid fa-cart-plus me-1"></i>Añadir Bundle</button>
          </div>
        </div>
      </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
      <div class="offcanvas-header navbar-truxup">
        <h5 class="offcanvas-title text-white" id="cartOffcanvasLabel"><i class="fa-solid fa-cart-shopping me-2"></i>Mi Carrito</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body p-0" id="cart-offcanvas-body"></div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-truxup fixed-top">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
          <img src="{{ asset('img/logo-trux-up.png') }}" alt="Logo" width="100" height="45" class="me-2">
          <span class="fw-bold">Trux-up</span>
        </a>
      
        <div class="d-flex align-items-center gap-2 ms-auto order-lg-last">
            <div class="d-none d-md-flex me-2">
              <div class="input-group input-group-sm">
                <input type="text" id="global-search" class="form-control rounded-pill-start border-0" placeholder="Buscar..." style="width:150px;">
                <button class="btn btn-warning rounded-pill-end" id="btn-global-search"><i class="fa-solid fa-search"></i></button>
              </div>
            </div>
            <button class="btn cart-btn-nav position-relative" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" title="Carrito">
              <i class="fa-solid fa-cart-shopping fs-5"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark" id="cart-badge" style="display:none; font-size: 0.6rem;">0</span>
            </button>
            <button class="btn cart-btn-nav" id="darkmode-toggle" title="Modo oscuro">
              <i class="fa-solid fa-moon fs-5"></i>
            </button>
        </div>

        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Menú">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2 me-lg-5">
            <li class="nav-item"><a class="nav-link ${currentPage === 'index.html' ? 'active fw-bold' : ''}" href="{{ route('home') }}">Inicio</a></li>
            <li class="nav-item"><a class="nav-link ${currentPage === 'productos.html' ? 'active fw-bold' : ''}" href="{{ route('products') }}" html">Productos</a></li>
            <li class="nav-item"><a class="nav-link ${currentPage === 'acercade.html' ? 'active fw-bold' : ''}" href="{{ route('about') }}">Nosotros</a></li>
            
            <li class="nav-item auth-guest"><a class="nav-link me-lg-5 ${request()->routeIs('home') ? 'active fw-bold' : ''}" href="{{ route('login') }}">Ingresar</a></li>
            
            
            <li class="nav-item auth-user d-none">
              <a class="nav-link d-flex align-items-center gap-2" href="${base}historial-compras.html">
                <i class="fa-solid fa-clock-rotate-left fs-5"></i>
                <span class="d-lg-none">Mis Pedidos</span>
              </a>
            </li>
            <li class="nav-item auth-user d-none">
              <a class="nav-link d-flex align-items-center gap-2" href="${base}perfil.html">
                <i class="fa-solid fa-user-circle fs-5"></i>
                <span class="d-lg-none">Mi Perfil</span>
              </a>
            </li>
            <li class="nav-item auth-admin d-none">
              <a class="nav-link btn btn-sm btn-outline-warning text-dark fw-bold px-3 ms-lg-2 my-2 my-lg-0" href="${base}admin-panel.html">
                <i class="fa-solid fa-lock me-1 d-lg-none"></i>Panel Admin
              </a>
            </li>
            <li class="nav-item auth-user d-none">
              <a class="nav-link logout-btn d-flex align-items-center gap-2 text-danger" href="#">
                <i class="fa-solid fa-sign-out-alt fs-5"></i>
                <span class="d-lg-none">Cerrar Sesión</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
