<div class="modal fade" id="kt_modal_update_password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">{{ __('Restablecer Contraseña de ') }} <span id="user_name_reset">{{ $user->name }}</span></h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                {{-- La acción se establecerá con JS para el ID específico --}}
                <form id="kt_modal_update_password_form" class="form" action="#" method="POST"> 
                    @csrf
                    @method('PUT') {{-- Usamos PUT para la acción de actualización --}}
                    
                    {{-- Campo Oculto para el ID del Usuario --}}
                    <input type="hidden" name="user_id_to_update" id="user_id_to_update" value="{{ $user->id }}" />
                    
                    <div class="alert alert-warning d-flex align-items-center p-5 mb-10">
                        <i class="ki-duotone ki-information fs-2 me-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <div class="d-flex flex-column">
                            <h5 class="mb-1 text-warning">{{ __('Advertencia de Seguridad') }}</h5>
                            <span>{{ __('Al guardar, se establecerá la nueva contraseña sin requerir la contraseña anterior del usuario.') }}</span>
                        </div>
                    </div>

                    {{-- 🛑 ELIMINAMOS LA CONTRASEÑA ACTUAL 🛑 --}}
                    
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <div class="mb-1">
                            <label class="form-label fw-semibold fs-6 mb-2">{{ __('Nueva Contraseña') }}</label>
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="new_password" autocomplete="off" />
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-1"></i>
                                    <i class="bi bi-eye d-none fs-1"></i>
                                </span>
                            </div>
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            </div>
                        <div class="text-muted">{{ __('Use 8 o más caracteres con una mínimo una letra mayuscula, números y símbolos.') }}</div>
                        </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fw-semibold fs-6 mb-2">{{ __('Confirmar Nueva Contraseña') }}</label>
                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="new_password_confirmation" autocomplete="off" />
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" data-kt-users-modal-action="cancel">{{ __('Descartar') }}</button>
                        <button type="submit" class="btn btn-primary" id="kt_modal_update_password_submit">
                            <span class="indicator-label">{{ __('Restablecer Contraseña') }}</span>
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
    document.addEventListener('DOMContentLoaded', function() {
    const modalId = 'kt_modal_update_password';
    const form = document.getElementById('kt_modal_update_password_form');
    const submitButton = document.getElementById('kt_modal_update_password_submit');

    // Función para limpiar errores y clases de Bootstrap
    function clearErrors() {
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    }

    // Función principal de envío AJAX
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors();
            
            // Mostrar spinner de carga
            submitButton.setAttribute('data-kt-indicator', 'on');

            const userId = document.getElementById('user_id_to_update').value;
            const actionUrl = '{{ route("user-management.users.index") }}/' + userId;

            // Usamos FormData para manejar el PUT spoofing y los datos
            const formData = new FormData(form);
            formData.append('_method', 'PUT'); 

            $.ajax({
                url: actionUrl,
                method: 'POST', // Usamos POST para AJAX con spoofing
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    $('#' + modalId).modal('hide');
                    toastr.success(response.message || 'Contraseña restablecida.');
                    // Es necesario recargar el panel para asegurar que el usuario tenga que iniciar sesión
                    setTimeout(() => { window.location.reload(); }, 500); 
                },
                
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        
                        // 🛑 MOSTRAR ERRORES DE VALIDACIÓN EN EL MODAL 🛑
                        $.each(errors, function(key, messages) {
                            const inputElement = form.querySelector(`[name="${key}"]`);
                            if (inputElement) {
                                inputElement.classList.add('is-invalid');
                                
                                // Creamos y añadimos el mensaje de feedback
                                const errorMessage = document.createElement('div');
                                errorMessage.className = 'invalid-feedback';
                                errorMessage.textContent = messages[0];
                                inputElement.parentNode.appendChild(errorMessage);
                            }
                        });
                        toastr.error('La contraseña no cumple los requisitos de seguridad.');
                    } else {
                        toastr.error('Error de servidor o conflicto de ID.');
                    }
                },
                
                complete: function() {
                    submitButton.removeAttribute('data-kt-indicator');
                }
            });
        });
    }
});
</script>