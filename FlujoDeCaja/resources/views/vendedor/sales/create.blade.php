@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Registrar Nueva Venta</h1>

    <form action="{{ route('vendedor.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="product_id" class="form-label">Producto</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->name }} - ${{ number_format($producto->price, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Cantidad</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Registrar Venta</button>
        <a href="{{ route('vendedor.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
