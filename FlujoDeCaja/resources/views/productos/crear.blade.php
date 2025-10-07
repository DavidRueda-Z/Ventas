<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Registrar nuevo Producto</h1>

        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="border rounded px-2 py-1 w-full" required>
            </div>

            <div class="mb-3">
                <label>Precio:</label>
                <input type="number" name="precio" step="0.01" class="border rounded px-2 py-1 w-full" required>
            </div>

            <div class="mb-3">
                <label>Stock:</label>
                <input type="number" name="existencias" class="border rounded px-2 py-1 w-full" required>
            </div>

            <div class="mb-3">
                <label>Descripción:</label>
                <textarea name="descripcion" class="border rounded px-2 py-1 w-full"></textarea>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
