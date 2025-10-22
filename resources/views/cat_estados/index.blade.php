<x-default-layout>

<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Buscar estados...">
</div>

<div class="container">
    <h1>Catálogo de Estados de Denuncia</h1>
    <a href="{{ route('cat_estados.create') }}" class="btn btn-primary mb-3">Nuevo Estado</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Tipo</th>
                <th>Nombre</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estados as $e)
            <tr>
                <td class="{{ !$e->is_active ? 'opacity-50' : '' }}">{{ $e->id_estado }}</td>
                <td class="{{ !$e->is_active ? 'opacity-50' : '' }}">{{ $e->id_tipo }}</td>
                <td class="{{ !$e->is_active ? 'opacity-50' : '' }}">{{ $e->nombre }}</td>
                <td class="{{ !$e->is_active ? 'opacity-50' : '' }}">
                    @if($e->is_active)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('cat_estados.edit', $e->id_estado) }}" class="btn btn-sm btn-warning">Editar</a>

                    @if($e->is_active)
                        <form action="{{ route('cat_estados.destroy', $e->id_estado) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="width:90px;">Desactivar</button>
                        </form>
                    @else
                        <form action="{{ route('cat_estados.activate', $e->id_estado) }}" method="POST" class="d-inline">
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
