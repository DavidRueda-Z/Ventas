@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar producto</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection