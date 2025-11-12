<x-default-layout>

    @section('title')
        {{ __('Gestión Jerárquica de Áreas') }}
    @endsection

    <div class="card shadow-sm">
        <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('Catálogo de Áreas') }}</span>
                <span class="text-muted mt-1 fw-semibold fs-7">{{ __('Administración de la estructura organizacional para el turno de denuncias.') }}</span>
            </h3>
            <div class="card-toolbar">
                <button type="button" id="kt_create_area" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> {{ __('Nueva Área') }}
                </button>
                <button type="button" id="kt_rename_area" class="btn btn-light me-2">
                    <i class="fas fa-edit"></i> {{ __('Renombrar') }}
                </button>
                <button type="button" id="kt_delete_area" class="btn btn-light-danger">
                    <i class="fas fa-trash"></i> {{ __('Eliminar') }}
                </button>
            </div>
        </div>

        <div class="card-body py-4">
            {{-- Contenedor donde se inicializará jsTree --}}
            <div id="area_jstree" class="border p-5">
                {{ __('Cargando estructura de áreas...') }}
            </div>
        </div>
    </div>

    @push('scripts')
        <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" />
        <script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>
        <script>
            // Token CSRF para todas las peticiones AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Inicialización de jsTree
            $(function () {
                $('#area_jstree').jstree({
                    "core": {
                        "data": {
                            // API para obtener los datos
                            "url": "{{ route('areas.tree_data') }}",
                            "dataType": "json" 
                        },
                        "check_callback": true, // Permite crear, mover, etc.
                        "themes": {
                            "responsive": true,
                            "variant": "small",
                            "stripes": true
                        }
                    },
                    "plugins": ["contextmenu", "dnd", "wholerow", "state"] // Añade funcionalidad de arrastrar, menú contextual, etc.
                });
            });

            // -----------------------------------------------------
            // 4. FUNCIONALIDAD DE BOTONES (CRUD)
            // -----------------------------------------------------
            
            // Crear nueva área raíz
            $('#kt_create_area').on('click', function () {
                Swal.fire({
                    title: 'Nueva Área',
                    html: 
                        // Utilizamos w-100 y mb-5 para que los inputs ocupen todo el ancho y tengan espacio
                        '<div class="mb-5 w-100">' +
                            '<label for="swal-nombre" class="form-label required">Nombre del Área</label>' +
                            // Se usa w-100 para forzar el ancho completo
                            '<input id="swal-nombre" class="form-control w-100" placeholder="Ej: Secretaría de Contraloría">' +
                        '</div>' +
                        '<div class="mb-5 w-100">' +
                            '<label for="swal-siglas" class="form-label">Siglas (Opcional)</label>' +
                            '<input id="swal-siglas" class="form-control w-100" placeholder="Ej: SECOEM">' +
                        '</div>' +
                        '<div class="mb-5 w-100">' +
                            // El nivel se cambia a type="text" y se añade un placeholder descriptivo.
                            '<label for="swal-nivel" class="form-label">Nivel (Ej: Secretaría, Dirección)(Opcional)</label>' +
                            // type="text" para coincidir con la migración
                            '<input id="swal-nivel" class="form-control w-100" type="text" value="" placeholder="Ej: Secretaría, Subsecretaría, Dirección, etc.">' + 
                        '</div>',
                    
                    // Configuraciones del Modal
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Crear Área',
                    showLoaderOnConfirm: true,
                    
                    // Función de Pre-Validación y captura de datos
                    preConfirm: () => {
                        const nombre = $('#swal-nombre').val();
                        const siglas = $('#swal-siglas').val();
                        const nivel = $('#swal-nivel').val();

                        if (!nombre) {
                            Swal.showValidationMessage('El nombre del área es obligatorio.');
                            return false;
                        }
                        // Devolvemos el objeto con los tres campos
                        return { text: nombre, siglas: siglas, nivel: nivel }; 
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        const data = result.value;
                        const tree = $('#area_jstree').jstree(true);

                        // Llamada a la API (areas.crud)
                        $.post("{{ route('areas.crud') }}", {
                            operation: 'create_node',
                            parent: '#',
                            text: data.text,
                            siglas: data.siglas,
                            nivel: data.nivel       // Se envía como string
                        }, function(response) {
                            // Actualizamos el árbol en el frontend
                            const areaText = `(${data.siglas || 'S/S'}) ${data.text}`; // Mostrar 'S/S' si no hay siglas
                            tree.create_node('#', {
                                id: response.id,
                                text: areaText, 
                                parent: '#'
                            }, "last");
                            tree.open_node('#');
                            Swal.fire('Creada', 'Área raíz creada con éxito.', 'success');
                        }).fail(function(xhr) {
                            Swal.fire('Error', 'No se pudo crear el área. ' + (xhr.responseJSON.error || ''), 'error');
                        });
                    }
                });
            });

            // Renombrar área seleccionada
            $('#kt_rename_area').on('click', function () {
                const tree = $('#area_jstree').jstree(true);
                const selected = tree.get_selected(true);
                if (selected.length === 0) {
                    Swal.fire('Atención', 'Seleccione un área para renombrar.', 'warning');
                    return;
                }
                const nodeId = selected[0].id;
                
                Swal.fire({
                    title: 'Renombrar Área',
                    input: 'text',
                    inputValue: selected[0].text,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    // ... (PreConfirm y Loader)
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ route('areas.crud') }}", {
                            operation: 'rename_node',
                            id: nodeId,
                            text: result.value
                        }, function() {
                            tree.set_text(nodeId, result.value); // Actualizar frontend
                            Swal.fire('Renombrado', 'El área se actualizó.', 'success');
                        }).fail(function() {
                            Swal.fire('Error', 'No se pudo renombrar el área.', 'error');
                        });
                    }
                });
            });

            // Eliminar área seleccionada
            $('#kt_delete_area').on('click', function () {
                const tree = $('#area_jstree').jstree(true);
                const selected = tree.get_selected(true);
                if (selected.length === 0) {
                    Swal.fire('Atención', 'Seleccione un área para eliminar.', 'warning');
                    return;
                }
                const nodeId = selected[0].id;

                Swal.fire({
                    title: '¿Está seguro?',
                    text: 'Se eliminará el área y sus hijos serán reasignados al nivel superior (o NULL).',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ route('areas.crud') }}", {
                            operation: 'delete_node',
                            id: nodeId
                        }, function() {
                            tree.delete_node(nodeId);
                            Swal.fire('Eliminado', 'El área ha sido eliminada.', 'success');
                        }).fail(function() {
                            Swal.fire('Error', 'No se pudo eliminar el área. Verifique dependencias.', 'error');
                        });
                    }
                });
            });

            $('#area_jstree').on('move_node.jstree', function (e, data) {
    
            // El evento 'move_node.jstree' se dispara después de que el movimiento es visualmente exitoso.
            // data.node: El nodo que fue movido.
            // data.parent: El ID del nuevo padre ('#' si es raíz).
            // data.old_parent: El ID del padre anterior.

            // Si el padre no cambió, no hacemos nada (aunque jsTree a veces maneja esto)
            if (data.parent === data.old_parent) {
                return;
            }

            // Mostrar alerta temporal para el usuario
            toastr.warning('Guardando cambios de jerarquía...', 'Movimiento Detectado');

            // Llamada AJAX para notificar al servidor sobre el movimiento
            $.post("{{ route('areas.crud') }}", {
                operation: 'move_node',
                id: data.node.id, // ID del nodo movido (el área)
                parent: data.parent, // Nuevo ID del padre ('#' o el id_area)
                // Opcional: data.position si quisieras guardar el orden
            })
            .done(function(response) {
                // El servidor retornó 200/true
                toastr.success('Jerarquía de áreas actualizada con éxito.', 'Movimiento Guardado');
            })
            .fail(function(xhr) {
                // Error de servidor (500) o validación.
                // Volver a cargar el árbol para reflejar el estado actual de la DB si falla
                $('#area_jstree').jstree(true).refresh(); 
                let errorMessage = 'Error al guardar el movimiento. Recargando datos.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage += ': ' + xhr.responseJSON.error;
                }
                toastr.error(errorMessage, 'Error de Transacción');
            });
        });
            
        </script>
    @endpush
</x-default-layout>