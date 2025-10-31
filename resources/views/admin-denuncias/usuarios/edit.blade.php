<x-default-layout>

    @section('title')
        {{ __('Editar Usuario') }}: {{ $user->name }}
    @endsection

    <div class="card shadow-sm">
        <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('Edición de Usuario Interno') }}</span>
                <span class="text-muted mt-1 fw-semibold fs-7">{{ __('Actualizando los datos de la cuenta ') }}<strong>{{ $user->email }}</strong></span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-light-primary">
                    <i class="fas fa-arrow-left me-2"></i> {{ __('Regresar al Listado') }}
                </a>
            </div>
        </div>

        <div class="card-body py-4">
            
            {{-- Formulario de Edición --}}
            <form method="POST" action="{{ route('admin.usuarios.update', $user) }}">
                @csrf
                @method('PUT') {{-- Importante para la ruta de actualización --}}

                <div class="row">
                    
                    <h4 class="mb-4">{{ __('Datos Generales') }}</h4>

                    {{-- 1. CAMPO NOMBRE COMPLETO --}}
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label required">{{ __('Nombre Completo') }}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required />
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 2. CAMPO CORREO / USUARIO --}}
                    <div class="col-md-6 mb-4">
                        <label for="email" class="form-label required">{{ __('Usuario (Correo)') }}</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required />
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 3. CAMPO ÁREA DE ADSCRIPCIÓN --}}
                    <div class="col-md-6 mb-4">
                        <label for="id_area" class="form-label required">{{ __('Área de Adscripción') }}</label>
                        <select name="id_area" id="id_area" class="form-select @error('id_area') is-invalid @enderror" data-control="select2" required>
                            <option value="">{{ __('Seleccione el área...') }}</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id_area }}" {{ old('id_area', $user->id_area) == $area->id_area ? 'selected' : '' }}>
                                    {{ $area->nombre_area }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_area') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 4. CAMPO ESTADO ACTIVO --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label">{{ __('Estado del Usuario') }}</label>
                        <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="is_active" 
                                id="is_active" 
                                value="1" 
                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                            />
                            <label class="form-check-label" for="is_active">
                                {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                            </label>
                        </div>
                        <input type="hidden" name="is_active" value="{{ old('is_active', $user->is_active) ? 1 : 0 }}">
                        @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <h4 class="mb-4 mt-5">{{ __('Cambio de Contraseña') }}</h4>
                    
                    {{-- 5. CAMPO CONTRASEÑA (Opcional) --}}
                    <div class="col-md-12 mb-4">
                        <label for="password" class="form-label">{{ __('Nueva Contraseña (Dejar vacío para mantener la actual)') }}</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" />
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                </div>
                
                <div class="d-flex justify-content-end mt-8">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-light me-3">{{ __('Cancelar') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Guardar Cambios') }}</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Script para inicializar Select2 en la vista de edición
            document.addEventListener('DOMContentLoaded', function () {
                $('#id_area').select2();

                // Manejar el valor del checkbox de forma explícita para asegurar que se envíe '0' o '1'
                const checkbox = document.getElementById('is_active');
                const hiddenInput = document.querySelector('input[name="is_active"][type="hidden"]');
                
                // Actualiza el hidden input al cambiar el checkbox
                checkbox.addEventListener('change', function() {
                    hiddenInput.value = this.checked ? '1' : '0';
                    this.nextElementSibling.innerText = this.checked ? 'Activo' : 'Inactivo';
                });
            });
        </script>
    @endpush

</x-default-layout>
