@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Mis Ventas</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('vendedor.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>

    @if($sales->isEmpty())
        <p>No tienes ventas registradas aún.</p>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product->name ?? 'Producto eliminado' }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>${{ number_format($sale->total, 0, ',', '.') }}</td>
                        <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('vendedor.show', $sale->id) }}" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
