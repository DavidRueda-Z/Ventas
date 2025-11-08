@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear producto</h1>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input name="name" value="{{ old('name') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input name="price" type="number" step="0.01" value="{{ old('price', 0) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <button class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
