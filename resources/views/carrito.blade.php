<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/#">Ecommerce de Libros</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('libros.index') }}">Ver Libros</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('carrito.ver') }}">Ver Carrito</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-4">Carrito de Compras</h1>

    <ul class="list-group mb-4">
        @foreach($carrito as $item)
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{ $item['libro']->titulo }}</h5>
                        <p class="mb-0">Precio: ${{ $item['libro']->precio }}</p>
                        <p class="mb-0">Cantidad: {{ $item['cantidad'] }}</p>
                    </div>
                    <div>
                        <p class="mb-0">Subtotal: ${{ $item['libro']->precio * $item['cantidad'] }}</p>
                    </div>
                    <!-- Agregar formulario para eliminar el libro del carrito -->
                    <form action="{{ route('carrito.eliminar', $item['libro']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Total</h5>
            <p class="card-text">Total a pagar: ${{ session('total', 0) }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ url('/') }}" class="btn btn-secondary">Seguir Comprando</a>
        <form action="{{ url('/iniciar_compra') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Iniciar Compra</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
