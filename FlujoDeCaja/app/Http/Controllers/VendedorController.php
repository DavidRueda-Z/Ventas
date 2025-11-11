<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendedorController extends Controller
{
    /**
     * Mostrar las ventas del vendedor actual.
     */
    public function index()
    {
        $sale = Sale::where('user_id', Auth::id())->get();
        return view('vendedor.sales.index', compact('sales'));
    }

    /**
     * Mostrar formulario para crear una venta nueva.
     */
    public function create()
    {
        $products = Product::all();
        return view('vendedor.sales.create', compact('products'));
    }

    /**
     * Guardar una venta en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $total = $product->price * $request->quantity;

        Sale::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total' => $total,
        ]);

        return redirect()->route('vendedor.sales.index')->with('success', 'Venta registrada correctamente.');
    }
}
