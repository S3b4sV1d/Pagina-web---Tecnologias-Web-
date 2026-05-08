<h1>Productos</h1>

@foreach($productos as $producto)
    <div>
        <h3>{{ $producto->nombre }}</h3>
        <p>{{ $producto->descripcion }}</p>
        <p>Precio: {{ $producto->precio }}</p>
        <p>Categoría: {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
    </div>
@endforeach