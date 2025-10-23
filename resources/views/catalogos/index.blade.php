<x-default-layout>
<div class="container">
    <h1>Catálogos</h1>

    <div class="mb-3">
        <input type="text" id="searchCatalogos" class="form-control" placeholder="Buscar catálogos...">
    </div>

    <table class="table table-bordered align-middle" id="catalogosTable">
        <thead>
            <tr>
                <th>Nombre del Catálogo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Municipios</td>
                <td><a href="{{ route('cat_municipios.index') }}" class="btn btn-primary btn-sm">Abrir</a></td>
            </tr>
            <tr>
                <td>Estados de denuncia</td>
                <td><a href="{{ route('cat_estados.index') }}" class="btn btn-primary btn-sm">Abrir</a></td>
            </tr>
            <tr>
                <td>Áreas de Gobierno</td>
                <td><a href="{{ route('cat_areas_gob.index') }}" class="btn btn-primary btn-sm">Abrir</a></td>
            </tr>
             <tr>
                <td>Áreas</td>
                <td><a href="{{ route('cat_areas_gob.index') }}" class="btn btn-primary btn-sm">Abrir</a></td>
            </tr>


            {{-- Aquí luego puedes agregar otros catálogos como usuarios, productos, etc. --}}
        </tbody>
    </table>
</div>

<script>
    const searchInput = document.getElementById('searchCatalogos');
    const tableRows = document.querySelectorAll('#catalogosTable tbody tr');

    searchInput.addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });
</script>
</x-default-layout>
