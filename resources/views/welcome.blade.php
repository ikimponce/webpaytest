<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce de Libros</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Ecommerce de Libros</a>
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
    <h1 class="mb-4">Nuestros Libros Destacados</h1>
    <div class="row">
        @foreach ($libros as $libro)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <!img class="card-img-top" src="{{ asset('storage/' . $libro->imagen) }}" alt="{{ $libro->titulo }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $libro->titulo }}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $libro->autor }}</h6>
                        <p class="card-text">{{ $libro->descripcion }}</p>
                        <p class="card-text">Precio: ${{ $libro->precio }}</p>
                        <p class="card-text">Stock: {{ $libro->stock }}</p>
                        <form action="{{ route('carrito.agregar', $libro) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


</body>
</html>
