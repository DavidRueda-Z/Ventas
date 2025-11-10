@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Detalle de Venta #{{ $venta->id }}</h1>

    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Producto:</strong> {{ $venta->product->name ?? 'Producto eliminado' }}</p>
            <p><strong>Cantidad:</strong> {{ $venta->quantity }}</p>
            <p><strong>Total:</strong> ${{ number_format($venta->total, 0, ',', '.') }}</p>
            <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('vendedor.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
