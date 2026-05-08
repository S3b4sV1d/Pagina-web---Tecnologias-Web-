@extends('layouts.app')

@section('title', 'Inicio | Trux-up')

@section('content')


<!-- Hero Section -->
<section class="hero-section" id="hero">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-6">
        <div class="hero-content-left">
          <h1 class="display-3 fw-bold">Bienvenido a<br><span class="text-primary-gradient">Trux-up</span></h1>
          <p>Descubre miles de productos: ropa, electrónica, accesorios y mucho más. Compra con confianza y recibe tus pedidos rápidamente.</p>
          <div class="button-group">
            <a href="#productos-destacados" class="btn btn-hero btn-lg">
              <i class="fa-solid fa-magnifying-glass me-2"></i>Explorar Productos
            </a>
            <a href="#categorias" class="btn btn-secondary-hero btn-lg">Ver Categorías</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 text-center">
        <img src="{{asset( 'img/imagen-principal.png') }}" alt="Productos Trux-up" class="img-fluid rounded-3" style="max-height:420px;">
      </div>
    </div>
  </div>
</section>

<!-- Categorías Destacadas -->
<section class="categorias-section" id="categorias">
  <div class="container">
    <h2 class="section-title">Categorías Destacadas</h2>
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <a href="productos.html?category=Ropa" class="text-decoration-none">
          <div class="categoria-card">
            <div class="categoria-icon"><i class="fa-solid fa-shirt"></i></div>
            <h3>Ropa</h3>
            <p>Prendas de moda y estilo para cada ocasión</p>
            <span class="btn btn-sm btn-primary">Ver Más</span>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6">
        <a href="productos.html?category=Electrónica" class="text-decoration-none">
          <div class="categoria-card">
            <div class="categoria-icon"><i class="fa-solid fa-tv"></i></div>
            <h3>Electrónica</h3>
            <p>Dispositivos electrónicos de última generación</p>
            <span class="btn btn-sm btn-primary">Ver Más</span>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6">
        <a href="productos.html?category=Computadoras y Laptops" class="text-decoration-none">
          <div class="categoria-card">
            <div class="categoria-icon"><i class="fa-solid fa-computer"></i></div>
            <h3>Computadoras y Laptops</h3>
            <p>Equipos principales de cómputo y portátiles</p>
            <span class="btn btn-sm btn-primary">Ver Más</span>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6">
        <a href="productos.html?category=Periféricos" class="text-decoration-none">
          <div class="categoria-card">
            <div class="categoria-icon"><i class="fa-solid fa-computer-mouse"></i></div>
            <h3>Periféricos</h3>
            <p>Teclados, monitores, ratones y más</p>
            <span class="btn btn-sm btn-primary">Ver Más</span>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6">
        <a href="productos.html?category=Audio y Sonido" class="text-decoration-none">
          <div class="categoria-card">
            <div class="categoria-icon"><i class="fa-solid fa-headphones"></i></div>
            <h3>Audio y Sonido</h3>
            <p>Auriculares, parlantes y equipos de audio</p>
            <span class="btn btn-sm btn-primary">Ver Más</span>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6">
        <a href="productos.html?category=Gaming" class="text-decoration-none">
          <div class="categoria-card">
            <div class="categoria-icon"><i class="fa-solid fa-gamepad"></i></div>
            <h3>Gaming</h3>
            <p>Todo para jugadores exigentes</p>
            <span class="btn btn-sm btn-primary">Ver Más</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Productos Destacados -->
<section class="productos-section" id="productos-destacados">
  <div class="container">
    <h2 class="section-title">Productos Destacados</h2>

    <!-- Filter Tabs -->
    <div class="filter-tabs text-center mb-4">
      <button class="btn-filter active" data-filter-cat="todos">Todos</button>
      <button class="btn-filter" data-filter-cat="Ropa">Ropa</button>
      <button class="btn-filter" data-filter-cat="Electrónica">Electrónica</button>
      <button class="btn-filter" data-filter-cat="Computadoras y Laptops">Laptops</button>
      <button class="btn-filter" data-filter-cat="Audio y Sonido">Audio</button>
      <button class="btn-filter" data-filter-cat="Gaming">Gaming</button>
      <button class="btn-filter" data-filter-cat="Telefonía">Telefonía</button>
    </div>

    <div class="row g-4">
      <!-- Producto 1 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Ropa">
        <div class="card producto-card h-100"
             data-product-id="ropa-1"
             data-product-name="Nike Sportswear Club T-Shirt"
             data-product-price="29.99"
             data-product-image="img/ropa/nike-polo-club.png"
             data-product-category="Ropa"
             data-product-rating="4.8">
          <img src="{{asset('img/ropa/nike-polo-club.png') }}"  class="card-img-top" alt="Nike Sportswear Club T-Shirt">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                <span class="rating-text">(4.8)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('ropa-1','Nike Sportswear Club T-Shirt')">Calificar</button>
            </div>
            <h5 class="card-title">Nike Sportswear Club T-Shirt</h5>
            <p class="card-text flex-grow-1">Cómoda camiseta de algodón con diseño clásico.</p>
            <p class="precio">S/. 29.99</p>
            <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
          </div>
        </div>
      </div>

      <!-- Producto 2 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Electrónica">
        <div class="card producto-card h-100"
             data-product-id="elec-1"
             data-product-name="Samsung Smart TV 55&quot;"
             data-product-price="499.99"
             data-product-image="img/electronica/samsung-tv-55-crystal.png"
             data-product-category="Electrónica"
             data-product-rating="4.8">
          <div class="producto-badge">-20%</div>
          <img src="{{ asset('img/electronica/samsung-tv-55-crystal.png') }}" class="card-img-top" alt="Samsung Smart TV 55">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                <span class="rating-text">(4.8)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('elec-1','Samsung Smart TV 55&quot;')">Calificar</button>
            </div>
            <h5 class="card-title">Samsung Smart TV 55"</h5>
            <p class="card-text flex-grow-1">Televisor 4K Crystal UHD con Smart TV.</p>
            <p class="precio"><span class="precio-original">S/. 624.99</span>S/. 499.99</p>
            <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
          </div>
        </div>
      </div>

      <!-- Producto 3 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Computadoras y Laptops">
        <div class="card producto-card h-100"
             data-product-id="comp-4"
             data-product-name="Apple MacBook Air M1"
             data-product-price="999.99"
             data-product-image="img/Computadoras y laptops/macbook-air-m1.png"
             data-product-category="Computadoras y Laptops"
             data-product-rating="4.9">
          <div class="producto-badge">-10%</div>
          <img src="{{ asset('img/Computadoras y laptops/macbook-air-m1.png')}}" class="card-img-top" alt="Apple MacBook Air M1">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <span class="rating-text">(4.9)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('comp-4','Apple MacBook Air M1')">Calificar</button>
            </div>
            <h5 class="card-title">Apple MacBook Air M1</h5>
            <p class="card-text flex-grow-1">Laptop ultra delgada con chip M1 de Apple.</p>
            <p class="precio"><span class="precio-original">S/. 1,110.99</span>S/. 999.99</p>
            <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
          </div>
        </div>
      </div>

      <!-- Producto 4 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Audio y Sonido">
        <div class="card producto-card h-100"
             data-product-id="aud-1"
             data-product-name="Sony WH-1000XM5"
             data-product-price="349.99"
             data-product-image="img/Audio y Sonido/sony-xm5.png"
             data-product-category="Audio y Sonido"
             data-product-rating="4.9">
          <img src="{{ asset('img/Audio y Sonido/sony-xm5.png') }} " class="card-img-top" alt="Sony WH-1000XM5">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <span class="rating-text">(4.9)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('aud-1','Sony WH-1000XM5')">Calificar</button>
            </div>
            <h5 class="card-title">Sony WH-1000XM5</h5>
            <p class="card-text flex-grow-1">Auriculares con cancelación de ruido premium.</p>
            <p class="precio">S/. 349.99</p>
            <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
          </div>
        </div>
      </div>

      <!-- Producto 5 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Gaming">
        <div class="card producto-card h-100"
             data-product-id="gam-4"
             data-product-name="ASUS TUF Gaming Monitor"
             data-product-price="349.99"
             data-product-image="img/gaming/asus-tuf-monitor.png"
             data-product-category="Gaming"
             data-product-rating="4.9">
          <img src=" {{ asset('img/Gaming/asus-tuf-monitor.png') }}" class="card-img-top" alt="ASUS TUF Gaming Monitor">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <span class="rating-text">(4.9)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('gam-4','ASUS TUF Gaming Monitor')">Calificar</button>
            </div>
            <h5 class="card-title">ASUS TUF Gaming Monitor</h5>
            <p class="card-text flex-grow-1">Monitor 240Hz para gaming competitivo.</p>
            <p class="precio">S/. 349.99</p>
            <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
          </div>
        </div>
      </div>

      <!-- Producto 6 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Telefonía">
        <div class="card producto-card h-100"
             data-product-id="tel-2"
             data-product-name="iPhone 13"
             data-product-price="799.99"
             data-product-image="img/telefonia/iphone-13.png"
             data-product-category="Telefonía"
             data-product-rating="4.9">
          <img src= "{{ asset('img/telefonia/iphone-13.png') }}" class="card-img-top" alt="iPhone 13">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <span class="rating-text">(4.9)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('tel-2','iPhone 13')">Calificar</button>
            </div>
            <h5 class="card-title">iPhone 13</h5>
            <p class="card-text flex-grow-1">Smartphone Apple con chip A15 Bionic.</p>
            <p class="precio">S/. 799.99</p>
            <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
          </div>
        </div>
      </div>

      <!-- Producto 7 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Accesorios Personales">
        <div class="card producto-card h-100"
             data-product-id="per-a1"
             data-product-name="Ray-Ban Aviator Classic"
             data-product-price="154.99"
             data-product-image="img/Accesorios personales/rayban-aviator.png"
             data-product-category="Accesorios Personales"
             data-product-rating="4.9">
          <img src= {{ asset('img/Accesorios personales/rayban-aviator.png') }} class="card-img-top" alt="Ray-Ban Aviator Classic">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <span class="rating-text">(4.9)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('per-a1','Ray-Ban Aviator Classic')">Calificar</button>
            </div>
            <h5 class="card-title">Ray-Ban Aviator Classic</h5>
            <p class="card-text flex-grow-1">Gafas de sol clásicas y versátiles.</p>
            <p class="precio">S/. 154.99</p>
            <button class="btn btn-primary w-100" data-add-to-cart>Agregar al carrito</button>
          </div>
        </div>
      </div>

      <!-- Producto 8 -->
      <div class="col-xl-3 col-lg-4 col-md-6 col-6 featured-product-item" data-product-category="Periféricos">
        <div class="card producto-card h-100"
             data-product-id="per-1"
             data-product-name="Logitech MX Master 3"
             data-product-price="99.99"
             data-product-image="img/perifericos/logitech-mx-master3.png"
             data-product-category="Periféricos"
             data-product-rating="4.8">
          <div class="producto-badge">-25%</div>
          <img src="{{ asset('img/Perifericos/logitech-mx-master3.png') }}" class="card-img-top" alt="Logitech MX Master 3">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <div class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                <span class="rating-text">(4.8)</span>
              </div>
              <button class="btn-rate-product" onclick="openRatingModal('per-1','Logitech MX Master 3')">Calificar</button>
            </div>
            <h5 class="card-title">Logitech MX Master 3</h5>
            <p class="card-text flex-grow-1">Ratón profesional inalámbrico de precisión.</p>
            <p class="precio"><span class="precio-original">S/. 133.32</span>S/. 99.99</p>
            <button class="btn btn-primary w-100 mb-2" data-add-to-cart>Agregar al carrito</button>
            <button class="btn btn-outline-accent w-100 btn-sm fw-bold" onclick="openBundleModal([
              {id:'per-1', name:'Logitech MX Master 3', price:99.99, image:'img/perifericos/logitech-mx-master3.png'},
              {id:'per-2', name:'Logitech K800 Keyboard', price:79.99, image:'img/perifericos/logitech-k800.png'}
            ])"><i class="fa-solid fa-layer-group me-2"></i>Ver Bundle (Pack)</button>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-4">
      <a href="{{ route('products') }}" class="btn btn-outline-primary btn-lg px-5 fw-bold">
        <i class="fa-solid fa-arrow-right me-2"></i>Ver todos los productos
      </a>
    </div>
  </div>
</section>

<!-- Ofertas y Promociones -->
<section class="promociones-section" id="ofertas">
  <div class="container">
    <h2 class="section-title">Ofertas y Promociones</h2>
    <div class="row g-4">
      <!-- Promo 1: Descuentos generales -->
      <div class="col-lg-6 col-md-6">
        <div class="promo-card" style="background-image:url('img/promo-1.png');">
          <div class="promo-overlay"></div>
          <div class="promo-content">
            <h3>Descuentos hasta 30%</h3>
            <p>En productos seleccionados de todas las categorías</p>
            <a href="productos.html?category=todos" class="btn btn-promo">Ver Ofertas</a>
          </div>
        </div>
      </div>

      <!-- Promo 2: Combo Gamer (bundle 3 productos) -->
      <div class="col-lg-6 col-md-6">
        <div class="promo-card" style="background-image:url('img/promo-2.png');">
          <div class="promo-overlay"></div>
          <div class="promo-content">
            <h3>Combo Gamer</h3>
            <p>Ratón + Teclado + Monitor gamer en un solo bundle</p>
            <button class="btn btn-promo" data-bundle='[{"id":"gam-1","name":"Razer DeathAdder V2","price":69.99,"image":"img/gaming/razer-deathadder-v2.png","category":"Gaming","rating":4.8},{"id":"gam-2","name":"HyperX Alloy FPS Pro","price":99.99,"image":"img/gaming/hyperx-fps-pro.png","category":"Gaming","rating":4.8},{"id":"gam-4","name":"ASUS TUF Gaming Monitor","price":349.99,"image":"img/gaming/asus-tuf-monitor.png","category":"Gaming","rating":4.9}]'>
              Ver Bundle
            </button>
          </div>
        </div>
      </div>

      <!-- Promo 3: Laptop + Mouse (bundle 2 productos) -->
      <div class="col-lg-6 col-md-6">
        <div class="promo-card" style="background-image:url('img/promo-3.png');">
          <div class="promo-overlay"></div>
          <div class="promo-content">
            <h3>Laptop + Mouse</h3>
            <p>MacBook Air M1 con Logitech MX Master 3</p>
            <button class="btn btn-promo" data-bundle='[{"id":"comp-4","name":"Apple MacBook Air M1","price":999.99,"image":"img/Computadoras y laptops/macbook-air-m1.png","category":"Computadoras y Laptops","rating":4.9},{"id":"per-1","name":"Logitech MX Master 3","price":99.99,"image":"img/perifericos/logitech-mx-master3.png","category":"Periféricos","rating":4.8}]'>
              Ver Bundle
            </button>
          </div>
        </div>
      </div>

      <!-- Promo 4: Flash Sale -->
      <div class="col-lg-6 col-md-6">
        <div class="promo-card" style="background-image:url('img/promo-4.png');">
          <div class="promo-overlay"></div>
          <div class="promo-content">
            <h3>Flash Sale</h3>
            <p>Ofertas por tiempo limitado en electrónica</p>
            <a href="productos.html?category=Electrónica" class="btn btn-promo">Ver Flash Sale</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Beneficios -->
<section class="beneficios-section">
  <div class="container">
    <h2 class="section-title">¿Por qué elegir Trux-up?</h2>
    <div class="row g-4">
      <div class="col-lg-3 col-md-6">
        <div class="beneficio-card">
          <div class="beneficio-icon"><i class="fa-solid fa-truck-fast"></i></div>
          <h3>Envío Rápido</h3>
          <p>Entrega en 24-48 horas a todo el país. Sin costo adicional en compras mayores a S/. 100.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="beneficio-card">
          <div class="beneficio-icon"><i class="fa-solid fa-lock"></i></div>
          <h3>Pago Seguro</h3>
          <p>Tus transacciones están protegidas con encriptación de nivel bancario.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="beneficio-card">
          <div class="beneficio-icon"><i class="fa-solid fa-undo"></i></div>
          <h3>Devoluciones Fáciles</h3>
          <p>30 días para cambios o devoluciones sin complicaciones ni preguntas.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="beneficio-card">
          <div class="beneficio-icon"><i class="fa-solid fa-headset"></i></div>
          <h3>Soporte 24/7</h3>
          <p>Nuestro equipo está disponible para ayudarte en cualquier momento.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
    <script src="{{ asset('js/ratings.js') }}"></script>
@endpush
@push('scripts')
    <script src="{{ asset('js/alerts.js') }}"></script>
@endpush
@push('scripts')
    <script src="{{ asset('js/cart.js') }}"></script>
@endpush


