<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Productos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">➕ Nuevo producto</a>

            <div class="mt-6 bg-white shadow-md rounded p-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Nombre</th>
                            <th class="border px-4 py-2">Precio</th>
                            <th class="border px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="border px-4 py-2">{{ $product->id }}</td>
                                <td class="border px-4 py-2">{{ $product->name }}</td>
                                <td class="border px-4 py-2">${{ $product->price }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
