<x-default-layout>

<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Buscar áreas...">
</div>

<div class="container">
    <h1>Catálogo de Áreas de Gobierno</h1>
    <a href="{{ route('cat_areas_gob.create') }}" class="btn btn-primary mb-3">Nueva Área</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Siglas</th>
                <th>Categoría</th>
                <th>Área Padre</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($areas as $a)
            <tr>
                <td class="{{ !$a->is_active ? 'opacity-50' : '' }}">{{ $a->id_area }}</td>
                <td class="{{ !$a->is_active ? 'opacity-50' : '' }}">{{ $a->nombre }}</td>
                <td class="{{ !$a->is_active ? 'opacity-50' : '' }}">{{ $a->siglas ?? '-' }}</td>
                <td class="{{ !$a->is_active ? 'opacity-50' : '' }}">{{ $a->categoria ?? '-' }}</td>
                <td class="{{ !$a->is_active ? 'opacity-50' : '' }}">{{ $a->padre ? $a->padre->nombre : '-' }}</td>
                <td class="{{ !$a->is_active ? 'opacity-50' : '' }}">
                    @if($a->is_active)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('cat_areas_gob.edit', $a->id_area) }}" class="btn btn-sm btn-warning">Editar</a>

                    @if($a->is_active)
                        <form action="{{ route('cat_areas_gob.destroy', $a->id_area) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="width:90px;">Desactivar</button>
                        </form>
                    @else
                        <form action="{{ route('cat_areas_gob.activate', $a->id_area) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success" style="width:90px;">Activar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const searchInput = document.getElementById('search');
    const tableRows = document.querySelectorAll('table tbody tr');

    searchInput.addEventListener('keyup', function() {
        const query = this.value.toLowerCase();

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });
</script>
</x-default-layout>
