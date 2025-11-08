@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Crear producto</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead><tr><th>Nombre</th><th>Precio</th><th>Acciones</th></tr></thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ number_format($p->price, 2) }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-secondary">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
