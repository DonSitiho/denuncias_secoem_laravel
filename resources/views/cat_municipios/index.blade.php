<x-default-layout>

<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Buscar municipios...">
</div>

<div class="container">
    <h1>Catálogo de Municipios</h1>
    <a href="{{ route('cat_municipios.create') }}" class="btn btn-primary mb-3">Nuevo Municipio</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($municipios as $m)
            <tr>
                   <td class="{{ !$m->is_active ? 'opacity-50' : '' }}">{{ $m->id_municipio }}</td>
                   <td class="{{ !$m->is_active ? 'opacity-50' : '' }}">{{ $m->nombre_municipio }}</td>
                   <td class="{{ !$m->is_active ? 'opacity-50' : '' }}">{{ $m->clave_municipio }}</td>
                   <td class="{{ !$m->is_active ? 'opacity-50' : '' }}">                 
                    @if($m->is_active)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('cat_municipios.edit', $m->id_municipio) }}" class="btn btn-sm btn-warning">Editar</a>

                    @if($m->is_active)
                        <form action="{{ route('cat_municipios.destroy', $m->id_municipio) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="width:90px;">Desactivar</button>
                        </form>
                    @else
                        <form action="{{ route('cat_municipios.activate', $m->id_municipio) }}" method="POST" class="d-inline">
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
</x-default-layout>

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
