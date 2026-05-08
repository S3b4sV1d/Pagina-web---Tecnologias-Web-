@extends('layouts.app')

@section('title', 'Acerca | Trux-up')

@section('content')

<!-- Register Section -->
<section class="auth-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="text-center mb-4">
          <h1 class="fw-bold mb-1">
            <i class="fa-solid fa-user-plus me-2 text-primary"></i>Crear Cuenta
          </h1>
          <p class="text-muted">Únete a Trux-up y disfruta de miles de productos</p>
        </div>

        <div class="login-card p-4">
          <form id="registerForm" novalidate>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-user me-2 text-primary"></i>Nombre Completo</label>
                <input type="text" class="form-control" id="registerName" placeholder="Tu nombre completo" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-id-card me-2 text-primary"></i>DNI / Cédula</label>
                <input type="text" class="form-control" id="registerDNI" placeholder="12345678" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-person me-2 text-primary"></i>Sexo</label>
                <select class="form-select" id="registerSex" required>
                  <option value="" disabled selected>Selecciona tu sexo</option>
                  <option value="masculino">Masculino</option>
                  <option value="femenino">Femenino</option>
                  <option value="otro">Otro</option>
                  <option value="prefiero-no">Prefiero no especificar</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-calendar me-2 text-primary"></i>Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="registerBirthDate" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-envelope me-2 text-primary"></i>Correo Electrónico</label>
                <input type="email" class="form-control" id="registerEmail" placeholder="tu@email.com" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-phone me-2 text-primary"></i>Teléfono</label>
                <input type="tel" class="form-control" id="registerPhone" placeholder="+51 (1) 234-5678" required>
              </div>
              <div class="col-md-8">
                <label class="form-label fw-bold"><i class="fa-solid fa-map-marker-alt me-2 text-primary"></i>Dirección</label>
                <input type="text" class="form-control" id="registerAddress" placeholder="Calle, número, apartamento" required>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold"><i class="fa-solid fa-building me-2 text-primary"></i>Ciudad</label>
                <input type="text" class="form-control" id="registerCity" placeholder="Lima" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-lock me-2 text-primary"></i>Contraseña</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="registerPassword" placeholder="Mínimo 8 caracteres" required>
                  <button type="button" class="btn btn-outline-secondary" id="togglePass1"><i class="fa-solid fa-eye"></i></button>
                </div>
                <small class="text-muted"><i class="fa-solid fa-circle-info me-1 text-primary"></i>Mayúsculas, minúsculas y números</small>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold"><i class="fa-solid fa-lock me-2 text-primary"></i>Confirmar Contraseña</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="confirmPassword" placeholder="Confirma tu contraseña" required>
                  <button type="button" class="btn btn-outline-secondary" id="togglePass2"><i class="fa-solid fa-eye"></i></button>
                </div>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms" required>
                  <label class="form-check-label text-muted" for="terms">
                    Acepto los <a href="#" class="fw-bold text-decoration-none text-primary">términos y condiciones</a> y la <a href="#" class="fw-bold text-decoration-none text-primary">política de privacidad</a>
                  </label>
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-login-submit">
                  <i class="fa-solid fa-user-check me-2"></i>Crear Cuenta
                </button>
              </div>
            </div>

            <div class="d-flex align-items-center my-3">
              <hr class="flex-grow-1"><span class="px-3 text-muted small">O regístrate con</span><hr class="flex-grow-1">
            </div>
            <div class="d-flex justify-content-center gap-2 mb-3">
              <button type="button" class="btn btn-social-login" style="width:130px;"><i class="fa-brands fa-google me-1"></i>Google</button>
              <button type="button" class="btn btn-social-login" style="width:130px;"><i class="fa-brands fa-facebook me-1"></i>Facebook</button>
            </div>
          </form>
        </div>

        <div class="text-center mt-3">
          <p class="text-muted">¿Ya tienes cuenta? <a href="login.html" class="fw-bold text-decoration-none text-primary">Inicia sesión aquí</a></p>
          <small class="text-muted"><i class="fa-solid fa-shield-halved me-1 text-success"></i>Tu información está segura con encriptación bancaria.</small>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="global-footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="js/alerts.js"></script>
<script src="js/cart.js"></script>
<script type="module">
import { register } from './js/auth.js';

document.getElementById('registerForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const name     = document.getElementById('registerName').value.trim();
  const email    = document.getElementById('registerEmail').value.trim();
  const pass     = document.getElementById('registerPassword').value;
  const confirm  = document.getElementById('confirmPassword').value;
  const city     = document.getElementById('registerCity').value;
  const address  = document.getElementById('registerAddress').value;
  const termsChk = document.getElementById('terms').checked;

  if (!name || !email || !pass) { showToast('Completa todos los campos requeridos', 'warning'); return; }
  if (pass.length < 8)          { showToast('La contraseña debe tener al menos 8 caracteres', 'danger'); return; }
  if (pass !== confirm)         { showToast('Las contraseñas no coinciden', 'danger'); return; }
  if (!termsChk)                { showToast('Debes aceptar los términos y condiciones', 'warning'); return; }

  // UI Feedback
  const submitBtn = this.querySelector('button[type="submit"]');
  const originalText = submitBtn.innerHTML;
  submitBtn.disabled = true;
  submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Registrando...';

  const result = await register({ name, email, password: pass, city, address });

  if (result.success) {
    showToast(`¡Bienvenido a Trux-up, ${result.user.name}!`, 'success');
    setTimeout(() => window.location.href = 'index.html', 1200);
  } else {
    showToast(result.message || 'Error al registrarse', 'danger');
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalText;
  }
});

function toggleVis(btnId, inputId) {
  document.getElementById(btnId).addEventListener('click', function() {
    const inp = document.getElementById(inputId);
    const icon = this.querySelector('i');
    inp.type = inp.type === 'password' ? 'text' : 'password';
    icon.className = inp.type === 'text' ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
  });
}
toggleVis('togglePass1', 'registerPassword');
toggleVis('togglePass2', 'confirmPassword');
</script>
</body>
</html>
