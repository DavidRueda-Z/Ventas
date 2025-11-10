<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostrar listado de productos (solo Admin).
     */
    public function productsIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Mostrar formulario para crear un producto.
     */
    public function createProduct()
    {
        return view('admin.products.create');
    }

    /**
     * Guardar un nuevo producto en la base de datos.
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Mostrar formulario para editar un producto.
     */
    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Actualizar un producto existente.
     */
    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Asignar rol de administrador a un usuario.
     */
    public function promoteToAdmin(User $user)
    {
        $user->assignRole('admin');
        return back()->with('success', 'Usuario promovido a administrador.');
    }

    /**
     * Asignar rol de vendedor a un usuario.
     */
    public function assignVendedor(User $user)
    {
        $user->assignRole('vendedor');
        return back()->with('success', 'Usuario asignado como vendedor.');
    }
}
