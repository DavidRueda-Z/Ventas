<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_document' => 'nullable|string|max:255',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Crear venta
            $sale = Sale::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_document' => $request->customer_document,
                'total' => 0,
            ]);

            $total = 0;

            // Agregar los detalles
            foreach ($request->products as $productData) {
                $product = Product::find($productData['id']);
                $subtotal = $product->price * $productData['quantity'];

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $productData['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            // Actualizar el total
            $sale->update(['total' => $total]);

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Sale created successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error creating sale: ' . $e->getMessage()]);
        }
    }

    public function show(Sale $sale)
    {
        $sale->load('details.product');
        return view('sales.show', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}

