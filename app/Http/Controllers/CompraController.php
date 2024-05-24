<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function verCarrito(Request $request)
    {
    $carrito = $request->session()->get('carrito', []);

    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['libro']->precio * $item['cantidad'];
    }
    $request->session()->put('total', $total);

    return view('carrito', compact('carrito'));
    }

    public function agregarAlCarrito(Request $request, Libro $libro)
    {
        $carrito = $request->session()->get('carrito', []);

        if (isset($carrito[$libro->id])) {
            $carrito[$libro->id]['cantidad']++;
        } else {
            $carrito[$libro->id] = [
                'libro' => $libro,
                'cantidad' => 1,
            ];
        }

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['libro']->precio * $item['cantidad'];
        }

        $request->session()->put('carrito', $carrito);

        $request->session()->put('total', $total);

        return redirect()->route('carrito.ver')->with('success', 'Libro agregado al carrito');
    }

    public function eliminarDelCarrito(Request $request, Libro $libro)
{
    $carrito = $request->session()->get('carrito', []);

    if (isset($carrito[$libro->id])) {
        $carrito[$libro->id]['cantidad']--;

        if ($carrito[$libro->id]['cantidad'] <= 0) {
            unset($carrito[$libro->id]);
        }
    }
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['libro']->precio * $item['cantidad'];
    }

    $request->session()->put('carrito', $carrito);
    $request->session()->put('total', $total);

    return redirect()->route('carrito.ver')->with('success', 'Libro eliminado del carrito');
}

}
