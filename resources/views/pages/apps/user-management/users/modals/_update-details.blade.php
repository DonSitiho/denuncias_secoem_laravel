<div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            {{-- El action será actualizado por el JavaScript al abrir el modal --}}
            <form class="form" action="#" method="POST" id="kt_modal_update_user_form">
                @csrf
                @method('PUT') {{-- Utilizamos PUT para actualizar el recurso --}}
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
                
                <div class="modal-header" id="kt_modal_update_user_header">
                    <h2 class="fw-bold">{{ __('Editar Detalles: ') }} {{ $user->name }}</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross','fs-1') !!}
                    </div>
                    </div>
                <div class="modal-body px-5 my-7">
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_update_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_update_user_header" data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                        
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_user_info" role="button" aria-expanded="true"
                            aria-controls="kt_modal_update_user_user_info">{{ __('Información de Identidad') }}
                            <span class="ms-2 rotate-180">
                                <i class="ki-duotone ki-down fs-3"></i>
                            </span>
                        </div>
                        
                        <div id="kt_modal_update_user_user_info" class="collapse show">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">{{ __('Nombre Completo') }}</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Nombre completo" name="name" id="edit_name" value="{{ $user->name }}" required />
                                <div class="fv-plugins-message-container invalid-feedback" id="error_name"></div>
                            </div>
                            
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">{{ __('Email (Usuario)') }}</label>
                                <input type="email" class="form-control form-control-solid" placeholder="usuario@dominio.com" name="email" id="edit_email" value="{{ $user->email }}" required />
                                <div class="fv-plugins-message-container invalid-feedback" id="error_email"></div>
                            </div>
                        </div>
                        <div class="separator my-10"></div>
                        
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_adscription" role="button" aria-expanded="true"
                            aria-controls="kt_modal_update_user_adscription">{{ __('Adscripción y Estado') }}
                            <span class="ms-2 rotate-180">
                                <i class="ki-duotone ki-down fs-3"></i>
                            </span>
                        </div>
                        
                        <div id="kt_modal_update_user_adscription" class="collapse show">
                            
                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">{{ __('Área de Adscripción') }}</label>
                                <select name="id_area" id="edit_id_area" data-control="select2" data-placeholder="Seleccione un Área..." class="form-select form-select-solid"
                                    data-dropdown-parent="#kt_modal_update_details" required>
                                    <option value="">{{ __('Seleccione un Área...') }}</option>
                                    {{-- El catálogo $areas será llenado por JavaScript --}}
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="error_id_area"></div>
                            </div>

                            <div class="d-flex flex-column mb-7 fv-row">
                                <label class="fs-6 fw-semibold mb-2">{{ __('Estado de la Cuenta') }}</label>
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1" {{ $user->is_active ? 'checked' : '' }} />
                                    <label class="form-check-label" for="edit_is_active">
                                        {{ __('Activo / Inactivo') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    <button type="submit" class="btn btn-primary" id="kt_modal_update_submit">
                        <span class="indicator-label">{{ __('Guardar Cambios') }}</span>
                        <span class="indicator-progress">{{ __('Por favor espere...') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                </form>
            </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = $('#kt_modal_update_details');
        const form = $('#kt_modal_update_user_form');
        const submitButton = $('#kt_modal_update_submit');
        
        // 🛑 Función para cargar el catálogo de áreas (se asume que se pasa desde el host)
        let areasCache = null; // Usaremos esta variable para almacenar las áreas
        
        function loadAreaCatalog(currentAreaId) {
             // 1. Asumimos que los datos de las áreas están disponibles globalmente o se pasan a la vista 'show'
             // Si el AdminManagementController::index() pasa $areas, debes usar un endpoint AJAX aquí.
             
             // Aquí deberías hacer una llamada AJAX para obtener las áreas
             // Por simplicidad, usaremos un placeholder de cómo debería ser el AJAX
             
             // PLACAHOLDER DE INICIO:
             const areaSelect = $('#edit_id_area');
             areaSelect.empty();
             areaSelect.append(new Option("Seleccione un Área...", ""));

             // Esto simula la carga del catálogo (necesitas obtener $areas en tu controlador show)
             // Ejemplo: Simular un catálogo simple
             const simulatedAreas = [
                 { id_area: 1, nombre_area: 'Secretaría de Contraloría', siglas: 'SECOEM' },
                 { id_area: 10, nombre_area: 'Dirección de Auditoría', siglas: 'DA' },
             ];
             
             // Aquí debes usar el catálogo real pasado desde el controlador
             const realAreas = window.GLOBAL_AREAS_CATALOG || simulatedAreas;

             realAreas.forEach(area => {
                 const isSelected = area.id_area == currentAreaId;
                 areaSelect.append(new Option(`[${area.siglas}] ${area.nombre_area}`, area.id_area, isSelected, isSelected));
             });

             areaSelect.val(currentAreaId).trigger('change');
        }

        // ----------------------------------------------------
        // LÓGICA DE APERTURA DEL MODAL
        // ----------------------------------------------------

        modal.on('show.bs.modal', function() {
            // Cargar datos actuales del usuario en el formulario
            const userId = '{{ $user->id }}';
            const userAreaId = '{{ $user->id_area }}';

            // 1. Actualizar el action del form
            form.attr('action', '{{ route("user-management.users.index") }}/' + userId);
            
            // 2. Cargar datos básicos y estado
            $('#edit_name').val('{{ $user->name }}');
            $('#edit_email').val('{{ $user->email }}');
            $('#edit_is_active').prop('checked', {{ $user->is_active ? 'true' : 'false' }});
            
            // 3. Cargar el Select2 de Área
            loadAreaCatalog(userAreaId);

            // 4. Limpiar errores al abrir
            clearErrors();
        });
        
        // ----------------------------------------------------
        // LÓGICA DE SUBMIT AJAX (Actualizar)
        // ----------------------------------------------------

        form.on('submit', function(e) {
            e.preventDefault();
            
            submitButton.attr('data-kt-indicator', 'on');
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST', // Usamos POST con PUT spoofing
                data: form.serialize(),
                success: function(response) {
                    modal.modal('hide');
                    toastr.success(response.message || 'Detalles actualizados.');
                    // Recargar la página de detalles para reflejar los cambios
                    setTimeout(() => { window.location.reload(); }, 500); 
                },
                error: function(xhr) {
                    clearErrors();
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        // Mostrar errores de validación
                        $.each(errors, function(key, value) {
                            $(`#error_${key}`).text(value[0]);
                            $(`[name="${key}"]`).addClass('is-invalid');
                        });
                        toastr.error('Por favor, corrija los campos marcados.');
                    } else {
                        toastr.error('Error de servidor al intentar guardar.');
                    }
                },
                complete: function() {
                    submitButton.attr('data-kt-indicator', 'off');
                }
            });
        });
        
        // Función de ayuda para limpiar errores
        function clearErrors() {
            $('.invalid-feedback').empty();
            $('.form-control, .form-select').removeClass('is-invalid');
        }
    });
</script>