<div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            
            <div class="modal-header">
                <h2 class="fw-bold">{{ __('Actualizar Rol de Acceso') }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                
                {{-- Contenedor de mensajes de error de AJAX --}}
                <div id="role_error_alert" class="alert alert-danger d-none fw-semibold"></div>

                <form id="kt_modal_update_role_form" class="form" action="#" method="POST">
                    @csrf
                    {{-- El método PUT se añade en el JS para compatibilidad AJAX --}}
                    
                    {{-- Campo Oculto para el ID del Usuario (Verificación) --}}
                    <input type="hidden" name="user_id_to_update" id="role_user_id_to_update" value="{{ $user->id }}" />
                    
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <i class="ki-duotone ki-information fs-2tx text-primary me-4">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">{{ __('Rol Actual: ') }} 
                                    <span class="fw-bolder">{{ $user->roles->first()->name ?? __('Sin Rol Asignado') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-5 required">{{ __('Seleccionar Nuevo Rol') }}</label>
                        
                        {{-- 🛑 Bucle que itera sobre los roles (excluyendo el ID 1) 🛑 --}}
                        @forelse($roles->filter(fn($role) => $role->id !== 1) as $role)
                            @php
                                $isChecked = $user->hasRole($role->name);
                                $isDisabled = (Auth::id() == $user->id); // Bloquear el cambio del propio usuario
                            @endphp
                            
                            <div class="d-flex mb-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input 
                                        class="form-check-input me-3" 
                                        name="role_name" 
                                        type="radio" 
                                        value="{{ $role->name }}" 
                                        id="role_option_{{ $role->id }}" 
                                        {{ $isChecked ? 'checked' : '' }}
                                        {{ $isDisabled ? 'disabled' : '' }}
                                    />
                                    <label class="form-check-label" for="role_option_{{ $role->id }}">
                                        <div class="fw-bold text-gray-800">{{ $role->name }}</div>
                                        <div class="text-gray-600">{{ $role->description ?? __('Sin descripción.') }}</div>
                                    </label>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <div class='separator separator-dashed my-3'></div>
                            @endif
                        @empty
                            <div class="alert alert-warning">No hay roles disponibles para asignar (aparte del Administrador General).</div>
                        @endforelse
                        
                        {{-- Contenedor de error de validación --}}
                        <div class="fv-plugins-message-container invalid-feedback" data-field="role_name"></div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn btn-primary" id="kt_modal_update_role_submit">
                            <span class="indicator-label">{{ __('Actualizar Rol') }}</span>
                            <span class="indicator-progress">{{ __('Por favor espere...') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalId = 'kt_modal_update_role';
        const form = document.getElementById('kt_modal_update_role_form');
        const submitButton = document.getElementById('kt_modal_update_role_submit');
        const errorAlert = document.getElementById('role_error_alert');

        // Función para limpiar errores del formulario
        function clearValidationErrors() {
            errorAlert.classList.add('d-none');
            errorAlert.textContent = '';
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
        }

        // 🛑 Lógica de submit AJAX 🛑
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                clearValidationErrors(); 
                
                submitButton.setAttribute('data-kt-indicator', 'on');

                const actionUrl = '{{ route("admin.usuarios.role.update", ["user" => $user->id]) }}';
                
                // 1. Usamos FormData para incluir el token CSRF y el spoofing
                const formData = new FormData(form);
                formData.append('_method', 'PUT'); // ⭐ Importante para la ruta PUT
                
                $.ajax({
                    url: actionUrl,
                    method: 'POST', // Siempre POST para AJAX/PUT spoofing
                    data: formData,
                    processData: false,
                    contentType: false,
                    
                    success: function(response) {
                        $('#' + modalId).modal('hide');
                        // ⭐ Estilo de éxito de Toastr
                        toastr.success(response.message || 'Rol actualizado con éxito.');
                        // Recargar la página para que los nuevos permisos se apliquen
                        setTimeout(() => { window.location.reload(); }, 500); 
                    },
                    
                    error: function(xhr) {
                        let errorMessage = 'Error al actualizar el rol.';
                        
                        if (xhr.status === 422) {
                            // 2. Manejo de error de validación (ej: no se seleccionó ningún rol)
                            const errors = xhr.responseJSON.errors;
                            errorMessage = errors.role_name ? errors.role_name[0] : 'Por favor, seleccione un rol.';
                            
                            // Mostrar error cerca del campo de radio/checkbox
                            const roleInput = form.querySelector('input[name="role_name"]');
                            if (roleInput) {
                                // Aquí puedes añadir el mensaje de error de validación de campo, 
                                // pero para radios/checkbox, Toastr es más efectivo.
                            }

                        } else if (xhr.status === 403 || xhr.status === 500) {
                            // 3. Manejo de error de seguridad (ej: intento de asignar Admin Global)
                            errorMessage = xhr.responseJSON.message || 'Error de servidor. El cambio fue rechazado.';
                            errorAlert.classList.remove('d-none').textContent = errorMessage;
                        }

                        toastr.error(errorMessage);
                    },
                    
                    complete: function() {
                        submitButton.removeAttribute('data-kt-indicator');
                    }
                });
            });
        }
    });
</script>