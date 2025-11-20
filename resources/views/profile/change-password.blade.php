<x-default-layout>
    @section('title')
        {{ __('Cambio de Contraseña') }}
    @endsection

    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">{{ __('Actualizar Contraseña de Acceso') }}</h3>
        </div>
        
        <form method="POST" action="{{ route('profile.update_password') }}" class="form" id="kt_password_change_form">
            @csrf
            
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                {{-- Contraseña Actual --}}
                <div class="fv-row mb-5">
                    <label class="required fw-semibold fs-6 mb-2">{{ __('Contraseña Actual') }}</label>
                    <input type="password" name="current_password" class="form-control form-control-lg form-control-solid @error('current_password') is-invalid @enderror" />
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- NUEVA CONTRASEÑA y PASSWORD METER --}}
                <div class="fv-row mb-5" data-kt-password-meter="true">
                    <label class="required fw-semibold fs-6 mb-2">{{ __('Nueva Contraseña') }}</label>
                    
                    <div class="position-relative mb-3">
                        <input type="password" name="new_password" id="new_password" class="form-control form-control-lg form-control-solid @error('new_password') is-invalid @enderror" required />
                        
                        {{-- Icono para mostrar/ocultar contraseña --}}
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                        
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- 🛑 PASSWORD METER DE METRONIC 🛑 --}}
                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                    </div>
                    {{-- Requisito de Fortaleza --}}
                    <div class="text-muted">{{ __('Debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y símbolos.') }}</div>
                </div>

                {{-- Confirmar Contraseña --}}
                <div class="fv-row mb-5">
                    <label class="required fw-semibold fs-6 mb-2">{{ __('Confirmar Nueva Contraseña') }}</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control form-control-lg form-control-solid" required />
                </div>
                
            </div>
            
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    {{ __('Guardar Contraseña') }}
                </button>
            </div>
        </form>
    </div>
</x-default-layout>