<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;

class CheckoutController extends Controller
{
    public function procesar()
    {
        $carrito = session()->get('carrito', []);

        if(empty($carrito)) {
            return redirect()->back()->with('error', 'Carrito vacío');
        }

        $total = 0;

        // Calcular total
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Crear venta
        $venta = Venta::create([
            'user_id' => auth()->id(),
            'fecha_venta' => now(),
            'total' => $total,
            'estado' => 1,
            'metodo_pago' => 'efectivo'
        ]);

        // Guardar detalle de venta
        foreach ($carrito as $id => $item) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);
        }

        // Vaciar carrito
        session()->forget('carrito');

        return redirect('/productos')->with('success', 'Compra realizada correctamente');
    }
}