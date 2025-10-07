<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Listado de Productos</h1>

        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nuevo Producto</a>

        <table class="mt-6 w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-2 py-1 border">ID</th>
                    <th class="px-2 py-1 border">Nombre</th>
                    <th class="px-2 py-1 border">Precio</th>
                    <th class="px-2 py-1 border">Existecias</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr>
                        <td class="border px-2 py-1">{{ $p->id }}</td>
                        <td class="border px-2 py-1">{{ $p->nombre }}</td>
                        <td class="border px-2 py-1">${{ $p->precio }}</td>
                        <td class="border px-2 py-1">{{ $p->existencias }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
