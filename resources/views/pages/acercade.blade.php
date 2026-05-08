@extends('layouts.app')

@section('title', 'Acerca | Trux-up')

@section('content')
  
    <section class="hero-section py-5" style="background: linear-gradient(135deg, var(--trux-primary) 0%, var(--trux-dark) 100%);">
      <div class="container text-center py-5">
        <h1 class="display-4 fw-bold text-white mb-3">Acerca de Trux-up</h1>
        <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 800px;">Conoce nuestra historia, valores y la pasión que nos impulsa a ser líderes en e-commerce.</p>
        <a href="#formulario-contacto" class="btn btn-light btn-lg fw-bold px-5 rounded-pill">
          <i class="fa-solid fa-envelope me-2"></i>Contáctanos
        </a>
      </div>
    </section>

 
    <section class="py-5" style="background-color: var(--bg-color);">
      <div class="container">
        <h2 class="section-title">Nuestra Historia</h2>

        <div class="timeline">
          <div class="timeline-item">
            <div class="timeline-marker"><i class="fa-solid fa-rocket"></i></div>
            <div class="timeline-content">
              <div class="timeline-icon"><i class="fa-solid fa-rocket"></i></div>
              <div class="timeline-year">2015</div>
              <div class="timeline-badge">INICIO</div>
              <div class="timeline-title">El Inicio</div>
              <p class="timeline-description">Fundamos Trux-up con la visión de revolucionar el comercio electrónico en Latinoamérica, ofreciendo productos de calidad a precios accesibles.</p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"><i class="fa-solid fa-globe"></i></div>
            <div class="timeline-content">
              <div class="timeline-icon"><i class="fa-solid fa-globe"></i></div>
              <div class="timeline-year">2017</div>
              <div class="timeline-badge">EXPANSIÓN</div>
              <div class="timeline-title">Expansión Regional</div>
              <p class="timeline-description">Expandimos nuestras operaciones a 5 países, alcanzando más de 100,000 clientes satisfechos en la región.</p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"><i class="fa-solid fa-bolt"></i></div>
            <div class="timeline-content">
              <div class="timeline-icon"><i class="fa-solid fa-lightbulb"></i></div>
              <div class="timeline-year">2019</div>
              <div class="timeline-badge">INNOVACIÓN</div>
              <div class="timeline-title">Innovación Tecnológica</div>
              <p class="timeline-description">Implementamos sistemas avanzados de logística y un nuevo portal web con experiencia de usuario mejorada.</p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"><i class="fa-solid fa-leaf"></i></div>
            <div class="timeline-content">
              <div class="timeline-icon"><i class="fa-solid fa-leaf"></i></div>
              <div class="timeline-year">2021</div>
              <div class="timeline-badge">SOSTENIBLE</div>
              <div class="timeline-title">Sostenibilidad</div>
              <p class="timeline-description">Iniciamos programas de responsabilidad social y adoptamos prácticas ecológicas en nuestras operaciones.</p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"><i class="fa-solid fa-crown"></i></div>
            <div class="timeline-content">
              <div class="timeline-icon"><i class="fa-solid fa-crown"></i></div>
              <div class="timeline-year">2023</div>
              <div class="timeline-badge">LIDERAZGO</div>
              <div class="timeline-title">Liderazgo Global</div>
              <p class="timeline-description">Nos consolidamos como uno de los principales marketplaces de Latinoamérica con más de 1 millón de clientes activos.</p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-marker"><i class="fa-solid fa-star"></i></div>
            <div class="timeline-content">
              <div class="timeline-icon"><i class="fa-solid fa-star"></i></div>
              <div class="timeline-year">2026</div>
              <div class="timeline-badge">HOY</div>
              <div class="timeline-title">Hoy</div>
              <p class="timeline-description">Continuamos innovando para brindar la mejor experiencia de compra en línea a nuestros clientes en toda la región.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Nuestros Valores -->
    <section class="py-5" style="background-color: var(--bg-card);">
      <div class="container">
        <h2 class="section-title">Nuestros Valores</h2>

        <div class="row g-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="valor-card">
              <div class="valor-icon">
                <i class="fa-solid fa-handshake"></i>
              </div>
              <div class="valor-title">Integridad</div>
              <div class="valor-description">Actuamos con honestidad y transparencia en cada transacción y relación con nuestros clientes y partners.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="valor-card">
              <div class="valor-icon">
                <i class="fa-solid fa-star"></i>
              </div>
              <div class="valor-title">Excelencia</div>
              <div class="valor-description">Buscamos constantemente mejorar la calidad de nuestros servicios y productos para satisfacer tus expectativas.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="valor-card">
              <div class="valor-icon">
                <i class="fa-solid fa-lightbulb"></i>
              </div>
              <div class="valor-title">Innovación</div>
              <div class="valor-description">Nos adaptamos a las nuevas tecnologías para ofrecer soluciones modernas y eficientes en el comercio digital.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="valor-card">
              <div class="valor-icon">
                <i class="fa-solid fa-leaf"></i>
              </div>
              <div class="valor-title">Sostenibilidad</div>
              <div class="valor-description">Nos comprometemos con el cuidado del ambiente y contribuimos a un futuro más verde y sostenible.</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" style="background-color: var(--bg-color);">
      <div class="container">
        <h2 class="section-title">Nuestra Esencia</h2>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="esencia-card">
              <div class="esencia-title">
                <i class="fa-solid fa-rocket"></i>
                Misión
              </div>
              <div class="esencia-content">
                Proporcionar una plataforma de compra en línea segura, accesible y confiable que conecte a millones de vendedores y compradores en Latinoamérica.
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="esencia-card">
              <div class="esencia-title">
                <i class="fa-solid fa-eye"></i>
                Visión
              </div>
              <div class="esencia-content">
                Ser el marketplace más innovador, inclusivo y confiable de Latinoamérica, transformando la forma en que las personas compran y venden en línea.
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="esencia-card">
              <div class="esencia-title">
                <i class="fa-solid fa-target"></i>
                Objetivo
              </div>
              <div class="esencia-content">
                Alcanzar 5 millones de usuarios activos, expandir a 10 países, y mantener los más altos estándares de calidad y seguridad en todas nuestras operaciones.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" style="background-color: var(--bg-card);">
      <div class="container">
        <h2 class="section-title">Nuestro Equipo</h2>

        <div class="row g-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Carlos Mendoza</div>
              <div class="member-position">CEO & Fundador</div>
              <div class="member-description">Emprendedor apasionado con 15 años de experiencia en comercio electrónico y liderazgo empresarial.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Laura García</div>
              <div class="member-position">CTO & Co-Fundadora</div>
              <div class="member-description">Ingeniera de software especializada en arquitectura escalable y seguridad en aplicaciones web.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Roberto Sánchez</div>
              <div class="member-position">COO - Operaciones</div>
              <div class="member-description">Experto en logística y gestión de operaciones con experiencia en múltiples países.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Sofía Rodríguez</div>
              <div class="member-position">Marketing & Branding</div>
              <div class="member-description">Especialista en estrategia digital y construcción de marca con resultados comprobados.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Miguel Álvarez</div>
              <div class="member-position">Atención al Cliente</div>
              <div class="member-description">Dedicado a garantizar la mejor experiencia y satisfacción de nuestros clientes en cada interacción.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Javier Castillo</div>
              <div class="member-position">Finanzas</div>
              <div class="member-description">Contador certificado con especialidad en gestión financiera y análisis de inversiones.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Valentina Cruz</div>
              <div class="member-position">Recursos Humanos</div>
              <div class="member-description">Profesional en gestión de talento enfocada en crear un ambiente laboral positivo e inclusivo.</div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="team-member">
              <div class="member-name">Daniel Flores</div>
              <div class="member-position">Seguridad & Compliance</div>
              <div class="member-description">Especialista en ciberseguridad y cumplimiento normativo con certificaciones internacionales.</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" style="background-color: var(--bg-color);">
      <div class="container">
        <h2 class="section-title">Nuestras Instalaciones</h2>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card instalacion-card">
              <div class="instalacion-image">
                <i class="fa-solid fa-warehouse"></i>
              </div>
              <div class="card-body">
                <h5 class="instalacion-title">Centro de Distribución</h5>
                <p class="instalacion-description">Instalación moderna de 50,000 m² equipada con tecnología de automatización para garantizar entregas rápidas y seguras.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card instalacion-card">
              <div class="instalacion-image">
                <i class="fa-solid fa-server"></i>
              </div>
              <div class="card-body">
                <h5 class="instalacion-title">Centro de Datos</h5>
                <p class="instalacion-description">Infraestructura tecnológica con servidores de última generación y sistemas de seguridad de clase mundial.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card instalacion-card">
              <div class="instalacion-image">
                <i class="fa-solid fa-headset"></i>
              </div>
              <div class="card-body">
                <h5 class="instalacion-title">Centro de Atención</h5>
                <p class="instalacion-description">Oficinas de soporte con equipos multilingües disponibles 24/7 para resolver cualquier consulta o incidencia.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card instalacion-card">
              <div class="instalacion-image">
                <i class="fa-solid fa-flask"></i>
              </div>
              <div class="card-body">
                <h5 class="instalacion-title">Centro de Innovación</h5>
                <p class="instalacion-description">Laboratorio de I+D donde desarrollamos nuevas tecnologías y mejoras para nuestros servicios.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card instalacion-card">
              <div class="instalacion-image">
                <i class="fa-solid fa-briefcase"></i>
              </div>
              <div class="card-body">
                <h5 class="instalacion-title">Oficinas Corporativas</h5>
                <p class="instalacion-description">Espacios de trabajo colaborativos diseñados para fomentar la creatividad y productividad de nuestro equipo.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card instalacion-card">
              <div class="instalacion-image">
                <i class="fa-solid fa-leaf"></i>
              </div>
              <div class="card-body">
                <h5 class="instalacion-title">Centro de Sostenibilidad</h5>
                <p class="instalacion-description">Área verde con iniciativas ecológicas e instalaciones sustentables para reducir nuestro impacto ambiental.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5" style="background-color: var(--bg-card);">
      <div class="container">
        <h2 class="section-title">Nuestra Ubicación</h2>

        <div class="row g-4 align-items-center">
          <div class="col-lg-6 col-md-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4891.042523626913!2d-79.04060262408643!3d-8.115327781208528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ad3d9fb3467261%3A0x752547ad9a204df6!2sUniversidad%20Nacional%20de%20Trujillo%20(UNT)!5e1!3m2!1ses!2spe!4v1777851568251!5m2!1ses!2spe" width="100%" height="400" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="col-lg-6 col-md-12">
            <div class="p-4 rounded-3 border-start border-5 border-primary" style="background: var(--bg-color);">
              <h3 class="fw-bold mb-4" style="color: var(--text-color);">Dirección Principal</h3>
              
              <div style="margin-bottom: 30px;">
                <h5 style="color: #0056FF; font-weight: bold; margin-bottom: 10px;">
                  <i class="fa-solid fa-location-dot"></i> Dirección
                </h5>
                <p style="color: #333; margin: 0;">Calle Principal 123, Piso 10, Centro Empresarial</p>
                <p style="color: #333; margin: 0;">Lima, Perú - Código Postal: 15001</p>
              </div>

              <div style="margin-bottom: 30px;">
                <h5 style="color: #0056FF; font-weight: bold; margin-bottom: 10px;">
                  <i class="fa-solid fa-phone"></i> Teléfono
                </h5>
                <p style="color: #333; margin: 0;">+51 (1) 234-5678</p>
                <p style="color: #333; margin: 0;">+51 (1) 234-5679</p>
              </div>

              <div style="margin-bottom: 30px;">
                <h5 style="color: #0056FF; font-weight: bold; margin-bottom: 10px;">
                  <i class="fa-solid fa-envelope"></i> Email
                </h5>
                <p style="color: #333; margin: 0;">contacto@truxup.com</p>
                <p style="color: #333; margin: 0;">soporte@truxup.com</p>
              </div>

              <div style="margin-bottom: 30px;">
                <h5 style="color: #0056FF; font-weight: bold; margin-bottom: 10px;">
                  <i class="fa-solid fa-clock"></i> Horario
                </h5>
                <p style="color: #333; margin: 0;">Lunes - Viernes: 9:00 AM - 6:00 PM</p>
                <p style="color: #333; margin: 0;">Sábado: 10:00 AM - 2:00 PM</p>
                <p style="color: #333; margin: 0;">Domingo: Cerrado</p>
              </div>

              <a href="#formulario-contacto" class="btn btn-primary" style="width: 100%; background: #0056FF; border: none; padding: 12px 0; font-size: 1.1rem;">Contactar Ahora</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Formulario de Contacto -->
    <section id="formulario-contacto" class="py-5" style="background-color: var(--bg-color);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10 col-sm-12">
            <h2 class="section-title">Formulario de Contacto</h2>
            <p class="text-center text-muted mb-5">Cuéntanos cómo podemos ayudarte. Nos pondremos en contacto pronto.</p>
            
            <form class="p-4 rounded-3 shadow-sm border" style="background: var(--bg-card);">
              <div class="row">
                <!-- Nombre -->
                <div class="col-md-6 col-sm-12 mb-3">
                  <label for="nombre" style="color: #002B5B; font-weight: bold; margin-bottom: 8px; display: block;">Nombre Completo</label>
                  <input type="text" class="form-control" id="nombre" placeholder="Tu nombre" style="border: 2px solid #e0e0e0; padding: 12px 15px; border-radius: 8px; transition: all 0.3s ease;" required>
                </div>

                <!-- Email -->
                <div class="col-md-6 col-sm-12 mb-3">
                  <label for="email" style="color: #002B5B; font-weight: bold; margin-bottom: 8px; display: block;">Correo Electrónico</label>
                  <input type="email" class="form-control" id="email" placeholder="tu@email.com" style="border: 2px solid #e0e0e0; padding: 12px 15px; border-radius: 8px; transition: all 0.3s ease;" required>
                </div>
              </div>

              <div class="row">
                <!-- Teléfono -->
                <div class="col-md-6 col-sm-12 mb-3">
                  <label for="telefono" style="color: #002B5B; font-weight: bold; margin-bottom: 8px; display: block;">Teléfono</label>
                  <input type="tel" class="form-control" id="telefono" placeholder="+51 (1) 234-5678" style="border: 2px solid #e0e0e0; padding: 12px 15px; border-radius: 8px; transition: all 0.3s ease;">
                </div>

                <!-- Asunto -->
                <div class="col-md-6 col-sm-12 mb-3">
                  <label for="asunto" style="color: #002B5B; font-weight: bold; margin-bottom: 8px; display: block;">Asunto</label>
                  <input type="text" class="form-control" id="asunto" placeholder="¿Cuál es tu consulta?" style="border: 2px solid #e0e0e0; padding: 12px 15px; border-radius: 8px; transition: all 0.3s ease;" required>
                </div>
              </div>

              <!-- Mensaje -->
              <div class="mb-3">
                <label for="mensaje" style="color: #002B5B; font-weight: bold; margin-bottom: 8px; display: block;">Mensaje</label>
                <textarea class="form-control" id="mensaje" rows="6" placeholder="Cuéntanos tu mensaje o consulta en detalle..." style="border: 2px solid #e0e0e0; padding: 12px 15px; border-radius: 8px; transition: all 0.3s ease; resize: none;" required></textarea>
              </div>

              <!-- Checkbox -->
              <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="terminos" style="border: 2px solid #0056FF; accent-color: #0056FF;" required>
                <label class="form-check-label" for="terminos" style="color: #555; margin-left: 8px;">
                  Acepto los términos y condiciones y la política de privacidad
                </label>
              </div>

              <!-- Botón Enviar -->
              <button type="submit" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #0056FF 0%, #003d99 100%); border: none; padding: 14px 0; font-size: 1.1rem; font-weight: bold; border-radius: 8px; transition: all 0.3s ease;">
                <i class="fa-solid fa-paper-plane"></i> Enviar Mensaje
              </button>
            </form>

            <!-- Información adicional -->
            <div style="margin-top: 40px; padding: 30px; background: white; border-radius: 15px; border-left: 5px solid #0056FF;">
              <div class="row g-4 text-center">
                <div class="col-md-4 col-sm-12">
                  <i class="fa-solid fa-phone" style="font-size: 2rem; color: #0056FF; margin-bottom: 10px; display: block;"></i>
                  <h5 style="color: #002B5B; font-weight: bold;">Teléfono</h5>
                  <p style="color: #555;">+51 (1) 234-5678</p>
                </div>
                <div class="col-md-4 col-sm-12">
                  <i class="fa-solid fa-envelope" style="font-size: 2rem; color: #0056FF; margin-bottom: 10px; display: block;"></i>
                  <h5 style="color: #002B5B; font-weight: bold;">Email</h5>
                  <p style="color: #555;">contacto@truxup.com</p>
                </div>
                <div class="col-md-4 col-sm-12">
                  <i class="fa-solid fa-clock" style="font-size: 2rem; color: #0056FF; margin-bottom: 10px; display: block;"></i>
                  <h5 style="color: #002B5B; font-weight: bold;">Horario</h5>
                  <p style="color: #555;">Lun-Vie 9AM-6PM</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


<div id="global-footer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="js/alerts.js"></script>
    <script src="js/cart.js"></script>
    <script>
    // Formulario de contacto con toast
    document.querySelector('#formulario-contacto form')?.addEventListener('submit', function(e) {
      e.preventDefault();
      showToast('¡Mensaje enviado! Nos pondremos en contacto pronto.', 'success');
      this.reset();
    });
    </script>
