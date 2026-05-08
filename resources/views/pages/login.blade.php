@extends('layouts.app')

@section('title', 'Acerca | Trux-up')

@section('content')

<!-- Login Section -->
<section class="auth-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="text-center mb-4">
          <h1 class="fw-bold mb-1">
            <i class="fa-solid fa-lock me-2 text-primary"></i>Iniciar Sesión
          </h1>
          <p class="text-muted">Bienvenido de vuelta a Trux-up</p>
        </div>

        <div class="login-card p-4">
          <form id="loginForm" novalidate>
            <div class="mb-3">
              <label for="loginEmail" class="form-label fw-bold">
                <i class="fa-solid fa-envelope me-2 text-primary"></i>Correo Electrónico
              </label>
              <input type="email" class="form-control" id="loginEmail" placeholder="tu@email.com" required>
            </div>

            <div class="mb-3">
              <label for="loginPassword" class="form-label fw-bold">
                <i class="fa-solid fa-lock me-2 text-primary"></i>Contraseña
              </label>
              <div class="input-group">
                <input type="password" class="form-control" id="loginPassword" placeholder="Tu contraseña" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMe">
                <label class="form-check-label text-muted" for="rememberMe">Recuérdame</label>
              </div>
              <a href="#" class="fw-bold text-decoration-none text-primary">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn btn-login-submit mb-3">
              <i class="fa-solid fa-arrow-right me-2"></i>Iniciar Sesión
            </button>

            <div class="d-flex align-items-center my-3">
              <hr class="flex-grow-1"><span class="px-3 text-muted small">O continúa con</span><hr class="flex-grow-1">
            </div>

            <div class="d-flex justify-content-center gap-2 mb-3">
              <button type="button" class="btn btn-social-login" style="width:130px;">
                <i class="fa-brands fa-google me-1"></i>Google
              </button>
              <button type="button" class="btn btn-social-login" style="width:130px;">
                <i class="fa-brands fa-facebook me-1"></i>Facebook
              </button>
            </div>
          </form>
        </div>

        <div class="text-center mt-3">
          <p class="text-muted">¿No tienes cuenta? <a href="registro.html" class="fw-bold text-decoration-none text-primary">Regístrate aquí</a></p>
          <small class="text-muted"><i class="fa-solid fa-shield-halved me-1 text-success"></i>Tu información está segura. Encriptación bancaria.</small>
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
import { login } from './js/auth.js';

const loginForm = document.getElementById('loginForm');
loginForm.addEventListener('submit', async function(e) {
  e.preventDefault();
  const email = document.getElementById('loginEmail').value.trim();
  const pass  = document.getElementById('loginPassword').value;

  if (!email || !pass) {
    showToast('Completa todos los campos', 'warning');
    return;
  }

  // Deshabilitar botón mientras carga
  const submitBtn = this.querySelector('button[type="submit"]');
  const originalText = submitBtn.innerHTML;
  submitBtn.disabled = true;
  submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Iniciando...';

  const result = await login(email, pass);

  if (result.success) {
    showToast(`¡Bienvenido de nuevo, ${result.user.name}!`, 'success');
    const redirectUrl = result.user.role === 'admin' ? 'admin-panel.html' : 'index.html';
    setTimeout(() => window.location.href = redirectUrl, 1000);
  } else {
    showToast(result.message || 'Error al iniciar sesión', 'danger');
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalText;
  }
});

// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
  const inp = document.getElementById('loginPassword');
  const icon = this.querySelector('i');
  if (inp.type === 'password') {
    inp.type = 'text';
    icon.className = 'fa-solid fa-eye-slash';
  } else {
    inp.type = 'password';
    icon.className = 'fa-solid fa-eye';
  }
});

// Redirigir si ya hay sesión
try {
  const user = JSON.parse(localStorage.getItem('truxup-user') || '{}');
  if (user.id) {
    window.location.href = user.role === 'admin' ? 'admin-panel.html' : 'index.html';
  }
} catch(e) {}
</script>
</body>
</html>
