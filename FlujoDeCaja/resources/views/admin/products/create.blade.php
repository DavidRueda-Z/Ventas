<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar producto') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">
                <form method="POST" action="{{ route('admin.products.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Nombre:</label>
                        <input type="text" name="name" class="border rounded w-full py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Precio:</label>
                        <input type="number" name="price" step="0.01" class="border rounded w-full py-2 px-3" required>
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
