{{-- admin-denuncias/usuarios/partials/modal_create_user.blade.php --}}



<div class="modal fade" tabindex="-1" id="modal_create_user">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">{{ __('Crear Nuevo Usuario Interno (Asignación por Área)') }}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

           

            <form method="POST" action="{{ route('admin.usuarios.store') }}">

                @csrf

                <div class="modal-body">

                   

                    <h4 class="mb-4">{{ __('Datos Personales (Para Generación de Cuenta)') }}</h4>



                    <div class="row mb-5">

                        {{-- 1. CAMPO NOMBRE --}}

                        <div class="col-md-4 mb-4">

                            <label for="name" class="form-label required">{{ __('Nombre(s)') }}</label>

                            <input type="text" name="name" id="name" class="form-control" required />

                        </div>

                       

                        {{-- 2. CAMPO APELLIDO PATERNO --}}

                        <div class="col-md-4 mb-4">

                            <label for="apellido_paterno" class="form-label required">{{ __('Apellido Paterno') }}</label>

                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" required />

                        </div>



                        {{-- 3. CAMPO APELLIDO MATERNO --}}

                        <div class="col-md-4 mb-4">

                            <label for="apellido_materno" class="form-label">{{ __('Apellido Materno (Opcional)') }}</label>

                            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" />

                        </div>

                       

                        <hr class="my-5">



                        <div class="col-md-12 mb-4">

                            <label for="username_part" class="form-label required">{{ __('Nombre de Usuario (Modificable)') }}</label>

                            <div class="input-group">

                                <input type="text" class="form-control" name="username_part" id="username_part" placeholder="Ej: jlopez.ortiz" required aria-label="Usuario"/>

                                <span class="input-group-text" id="domain_suffix">@denuncias.secoem.gob.mx</span>

                            </div>

                            <input type="hidden" name="email" id="email_final">

                            @error('email')

                                <div class="text-danger mt-1">{{ __('El nombre de usuario seleccionado se encuentra utilizado o es inválido, cámbielo por otro.') }}</div>

                            @enderror

                        </div>

                       

                        <div class="col-md-12 mb-4">

                            <label for="id_area" class="form-label required">{{ __('Área de Adscripción') }}</label>

                            {{-- Se usa $areas que es pasada desde index --}}

                            <select name="id_area" id="id_area_modal" class="form-select" data-control="select2" required>

                                <option value="">{{ __('Seleccione el área del usuario...') }}</option>

                                @if(isset($areas))

                                    @foreach ($areas as $area)

                                        <option value="{{ $area->id_area }}">[{{ $area->siglas }}] {{ $area->nombre_area }}</option>

                                    @endforeach

                                @endif

                            </select>

                        </div>

                       

                        {{-- Info sobre contraseñ --}}

                        <div class="col-md-12 mb-4">

                            <div class="alert alert-info">

                                {{ __('La contraseña inicial se establecerá por defecto como el mismo correo completo generado.') }}

                            </div>

                        </div>

                       

                    </div>

                </div>

               

                <div class="modal-footer">

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>

                    <button type="submit" class="btn btn-primary">{{ __('Generar Cuenta') }}</button>

                </div>

            </form>

        </div>

    </div>

</div>





<script>

    document.addEventListener('DOMContentLoaded', function () {

        const nameInput = document.getElementById('name');

        const paternoInput = document.getElementById('apellido_paterno');

        const maternoInput = document.getElementById('apellido_materno');

        const usernamePartInput = document.getElementById('username_part');

        const emailFinalInput = document.getElementById('email_final');

        const modal = document.getElementById('modal_create_user');

        const domainSuffix = '@denuncias.secoem.gob.mx';

   

        // Flag para detectar si el usuario ya editó el username manualmente

        let userManuallyEdited = false;

   

        // Genera el username base

        function generateUsernameBase() {

            const name = nameInput.value.trim().toLowerCase();

            const paterno = paternoInput.value.trim().toLowerCase();

            const materno = maternoInput.value.trim().toLowerCase();

   

            if (!name || !paterno) return '';

   

            const firstInitial = name.charAt(0);

            const cleanPaterno = paterno.replace(/[^a-z0-9]/g, '');

            const firstMaterno = materno.charAt(0) || '';

   

            return (firstInitial + cleanPaterno + firstMaterno).replace(/[^a-z0-9]/g, '');

        }

   

        // Autocompleta el username

        function autocompleteUsername() {

            if (!userManuallyEdited) {

                const base = generateUsernameBase();

                if (base) usernamePartInput.value = base;

            }

            updateFinalEmail();

        }

   

        // Actualiza el email completo oculto

        function updateFinalEmail() {

            const username = usernamePartInput.value.trim().toLowerCase();

            emailFinalInput.value = username + domainSuffix;

        }

   

        // Eventos

        nameInput.addEventListener('input', autocompleteUsername);

        paternoInput.addEventListener('input', autocompleteUsername);

        maternoInput.addEventListener('input', autocompleteUsername);

   

        // Detecta si el usuario modificó manualmente el username

        usernamePartInput.addEventListener('input', () => {

            userManuallyEdited = true;

            updateFinalEmail();

        });

   

        // Al abrir el modal, se genera automáticamente el username y el correo

        modal.addEventListener('shown.bs.modal', function () {

            userManuallyEdited = false;

            autocompleteUsername();

            updateFinalEmail();

        });

    });

    </script>