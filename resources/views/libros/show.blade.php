<!DOCTYPE html>
<html>
<head>
    <title>{{ $libro->titulo }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">{{ $libro->titulo }}</h1>
    <p>Autor: {{ $libro->autor }}</p>
    <p>Descripción: {{ $libro->descripcion }}</p>
    <p>Precio: ${{ $libro->precio }}</p>
    <p>Stock: {{ $libro->stock }}</p>
    <a href="{{ route('libros.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
</body>
</html>
