<x-default-layout>
<div class="container mt-4">
    <h1>Crear Nueva Área de Gobierno</h1>

    <form action="{{ route('cat_areas_gob.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="siglas" class="form-label">Siglas</label>
            <input type="text" name="siglas" id="siglas" class="form-control" value="{{ old('siglas') }}">
            @error('siglas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria') }}">
            @error('categoria')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id_area_padre" class="form-label">Área Padre</label>
            <select name="id_area_padre" id="id_area_padre" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($areas as $a)
                    <option value="{{ $a->id_area }}" {{ old('id_area_padre') == $a->id_area ? 'selected' : '' }}>
                        {{ $a->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_area_padre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('cat_areas_gob.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-default-layout>
