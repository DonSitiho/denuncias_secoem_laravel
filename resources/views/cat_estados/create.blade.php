
<x-default-layout>

<div class="container">
    <h3>Nuevo Estado</h3>

    <form action="{{ route('cat_estados.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">ID Tipo</label>
            <input type="number" name="id_tipo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('cat_estados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-default-layout>
