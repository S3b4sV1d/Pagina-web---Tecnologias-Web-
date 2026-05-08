@extends('layouts.app')

@section('title', 'Acerca | Trux-up')

@section('content')

<section class="py-5">
  <div class="container text-center py-5">
    <div class="p-5 rounded-4 shadow-sm border mx-auto" style="max-width: 600px; background: var(--bg-card);">
      <div class="mb-4">
        <i class="fa-solid fa-circle-check fa-5x text-success animate__animated animate__bounceIn"></i>
      </div>
      <h1 class="fw-bold mb-3" style="color: var(--trux-dark);">¡Pedido Confirmado!</h1>
      <p class="text-muted fs-5 mb-4">
        Gracias por confiar en Trux-up. Tu pedido ha sido procesado con éxito y estamos preparando todo para el envío.
      </p>
      
      <div class="p-3 bg-light rounded-3 mb-4 text-start">
        <div class="d-flex justify-content-between mb-2">
          <span class="text-muted">Número de Pedido:</span>
          <span class="fw-bold text-primary" id="order-id-display">PED-XXXX</span>
        </div>
        <div class="d-flex justify-content-between">
          <span class="text-muted">Tiempo estimado:</span>
          <span class="fw-bold">24-48 horas</span>
        </div>
      </div>

      <div class="d-grid gap-2">
        <a href="perfil.html#pedidos" class="btn btn-primary btn-lg fw-bold py-3">
          <i class="fa-solid fa-receipt me-2"></i>Ver Mis Pedidos
        </a>
        <a href="productos.html" class="btn btn-outline-secondary">
          Seguir Comprando
        </a>
      </div>
    </div>
    
    <div class="mt-5">
      <h5 class="text-muted mb-4">También te podría interesar:</h5>
      <div id="recommendations" class="row g-3 justify-content-center">
        <!-- JS cargará recomendaciones rápidas aquí -->
      </div>
    </div>
  </div>
</section>

<div id="global-footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const orderId = params.get('id') || 'PED-' + Date.now();
    document.getElementById('order-id-display').textContent = orderId;
  });
</script>
</body>
</html>
