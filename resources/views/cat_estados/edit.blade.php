<x-default-layout>
<div class="container">
    <h3>Editar Estado de la Denuncia</h3>

    <form action="{{ route('cat_estados.update', $estado->id_estado) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">ID Tipo</label>
            <input type="number" name="id_tipo" class="form-control" value="{{ $estado->id_tipo }}" {{ !$estado->is_active ? 'readonly' : '' }}>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $estado->nombre }}" {{ !$estado->is_active ? 'readonly' : '' }}>
        </div>

        @if($estado->is_active)
            <button type="submit" class="btn btn-success">Actualizar</button>
        @endif
        <a href="{{ route('cat_estados.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
</x-default-layout>
