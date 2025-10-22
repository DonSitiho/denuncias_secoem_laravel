<x-default-layout>
<div class="container">
    <h2>Editar Municipio</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cat_municipios.update', $municipio->id_municipio) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre_municipio" class="form-label">Nombre del Municipio</label>
            <input type="text" name="nombre_municipio" class="form-control" id="nombre_municipio" value="{{ old('nombre_municipio', $municipio->nombre_municipio) }}" required>
        </div>

        <div class="mb-3">
            <label for="clave_municipio" class="form-label">Clave del Municipio</label>
            <input type="text" name="clave_municipio" class="form-control" id="clave_municipio" value="{{ old('clave_municipio', $municipio->clave_municipio) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('cat_municipios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-default-layout>
