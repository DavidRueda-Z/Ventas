<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('detalles.producto')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('ventas.crear', compact('productos'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $request->validate([
                'cliente_nombre' => 'required|string',
                'cliente_documento' => 'nullable|string',
                'productos' => 'required|array',
                'productos.*.id' => 'required|exists:productos,id',
                'productos.*.cantidad' => 'required|integer|min:1',
            ]);

            // Crear la venta
            $venta = Venta::create([
                'cliente_nombre' => $request->cliente_nombre,
                'cliente_documento' => $request->cliente_documento,
                'total' => 0, // se calculará más adelante
            ]);

            $total = 0;

            // Recorrer los productos enviados
            foreach ($request->productos as $item) {
                $producto = Producto::findOrFail($item['id']);
                $cantidad = $item['cantidad'];
                $precio_unitario = $producto->precio;
                $subtotal = $precio_unitario * $cantidad;

                // Crear detalle
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'subtotal' => $subtotal,
                ]);

                // Actualizar stock del producto
                $producto->existencias -= $cantidad;
                $producto->save();

                $total += $subtotal;
            }

            // Actualizar total de la venta
            $venta->update(['total' => $total]);

            DB::commit();
            return redirect()->route('ventas.index')->with('exito', 'Venta registrada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocurrió un error: ' . $e->getMessage()]);
        }
    }

    public function show(Venta $venta)
    {
        $venta->load('detalles.producto');
        return view('ventas.detalle', compact('venta'));
    }
}
