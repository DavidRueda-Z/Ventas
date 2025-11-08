<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    // Productos
    public function productsIndex()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $data['created_by'] = Auth::id();
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Producto creado');
    }

    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado');
    }

    // Promover usuario a admin
    public function promoteToAdmin(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'No puedes modificar tu propio rol.');
        }

        $user->assignRole('admin');
        return back()->with('success', "Usuario {$user->email} promovido a admin.");
    }

    // Asignar rol vendedor
    public function assignVendedor(Request $request, User $user)
    {
        $user->assignRole('vendedor');
        return back()->with('success', "Usuario {$user->email} asignado como vendedor.");
    }
}