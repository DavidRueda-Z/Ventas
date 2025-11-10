@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Mis Ventas</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('vendedor.create') }}" class="btn btn-primary mb-3">Registrar Nueva Venta</a>

    @if($ventas->isEmpty())
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
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->product->name ?? 'Producto eliminado' }}</td>
                        <td>{{ $venta->quantity }}</td>
                        <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('vendedor.show', $venta->id) }}" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
