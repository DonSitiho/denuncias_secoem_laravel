<x-default-layout>

    @section('title')
        {{ __('Detalles del Usuario Interno') }} - {{ $user->name }}
    @endsection

    @section('breadcrumbs')
        {{-- Enlazar a la gestión de usuarios internos --}}
        {{ Breadcrumbs::render('user-management.users.index') }} 
    @endsection

    {{-- Mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    
                    <div class="d-flex flex-center flex-column py-5">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if($user->profile_photo_url)
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"/>
                            @else
                                <div class="symbol-label fs-3 bg-light-primary text-primary">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $user->name }}</a>
                        <div class="mb-9">
                            @foreach($user->roles as $role)
                                <div class="badge badge-lg badge-light-danger d-inline me-2">{{ ucwords($role->name) }}</div>
                            @endforeach
                            
                            @if ($user->area)
                                <div class="badge badge-lg badge-light-dark d-inline mt-2">
                                    {{ $user->area->nombre_area }} ({{ $user->area->siglas }})
                                </div>
                            @endif
                            
                            @if ($user->is_active)
                                <div class="badge badge-lg badge-light-success d-inline mt-2">{{ __('ACTIVO') }}</div>
                            @else
                                <div class="badge badge-lg badge-light-secondary d-inline mt-2">{{ __('INACTIVO') }}</div>
                            @endif
                        </div>
                        <div class="fw-bold mb-3">{{ __('Métricas de Responsabilidad') }}</div>
                        <div class="d-flex flex-wrap flex-center">
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    {{-- Aquí se integra la lógica del Repositorio de Denuncias para el usuario --}}
                                    <span class="w-75px">{{ $user->denunciasAsignadas->count() ?? 0 }}</span>
                                </div>
                                <div class="fw-semibold text-muted">{{ __('Denuncias Asignadas') }}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-50px">N/A</span>
                                </div>
                                <div class="fw-semibold text-muted">{{ __('Casos Cerrados') }}</div>
                            </div>
                            </div>
                        </div>
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">{{ __('Detalles de Cuenta') }}
                            <span class="ms-2 rotate-180">
                                <i class="ki-duotone ki-down fs-3"></i>
                            </span>
                        </div>
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="{{ __('Editar detalles del usuario') }}">
                            {{-- Enlace de edición para el Administrador (Abrirá modal de edición) --}}
                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">{{ __('Editar') }}</a>
                        </span>
                    </div>
                    <div class="separator"></div>
                    
                    <div id="kt_user_view_details" class="collapse show">
                        <div class="pb-5 fs-6">
                            
                            <div class="fw-bold mt-5">{{ __('Correo Electrónico') }}</div>
                            <div class="text-gray-600">
                                <a href="mailto:{{ $user->email }}" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
                            </div>
                            
                            <div class="fw-bold mt-5">{{ __('Área Asignada') }}</div>
                            <div class="text-gray-600">{{ $user->area->nombre_area ?? 'Sin Asignar' }}</div>
                            
                            <div class="fw-bold mt-5">{{ __('Último Inicio de Sesión') }}</div>
                            <div class="text-gray-600">{{ $user->last_login_at ? $user->last_login_at->format('d M Y, h:i a') : 'Nunca' }}</div>
                            
                        </div>
                    </div>
                    </div>
                </div>
            {{-- Sección de Cuentas Conectadas Adaptada --}}
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h3 class="fw-bold m-0">{{ __('Configuración de Seguridad') }}</h3>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="text-gray-600">
                        {{ __('Desde aquí el administrador puede restablecer la contraseña o modificar el rol del usuario.') }}
                    </div>
                    
                    <div class="py-2 mt-4">
                        <div class="d-flex flex-stack">
                            <div class="d-flex flex-column">
                                <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">{{ __('Contraseña') }}</a>
                                <div class="fs-6 fw-semibold text-muted">********</div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                    {{ __('Restablecer') }}
                                </button>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-5"></div>
                        <div class="d-flex flex-stack">
                            <div class="d-flex flex-column">
                                <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">{{ __('Rol del Sistema') }}</a>
                                <div class="fs-6 fw-semibold text-muted">{{ $user->roles?->first()->name ?? 'Sin Rol' }}</div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-light-warning" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                    {{ __('Cambiar Rol') }}
                                </button>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
            </div>
        <div class="flex-lg-row-fluid ms-lg-15">
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">{{ __('Denuncias y Tareas') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_security">{{ __('Eventos de Cuenta') }}</a>
                </li>
                <li class="nav-item ms-auto">
                    <a href="#" class="btn btn-primary ps-7">{{ __('Acciones') }}</a>
                </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                    
                    {{-- Adaptación del widget de tareas a la gestión de denuncias --}}
                    <div class="card card-flush mb-6 mb-xl-9">
                        <div class="card-header mt-6">
                            <div class="card-title flex-column">
                                <h2 class="mb-1">{{ __('Denuncias Asignadas (Activas)') }}</h2>
                                <div class="fs-6 fw-semibold text-muted">{{ __('Listado de casos turnados y en trámite.') }}</div>
                            </div>
                            <div class="card-toolbar">
                                {{-- Enlace a la bandeja filtrada del OIC --}}
                                <a href="{{ route('oic.mis-denuncias') }}" class="btn btn-light-primary btn-sm">{{ __('Ver Bandeja de Denuncias') }}</a>
                            </div>
                        </div>
                        <div class="card-body p-9 pt-4">
                        {{-- ⭐ TABLA DINÁMICA DE DENUNCIAS ASIGNADAS ⭐ --}}
                        <div class="table-responsive">
                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                <thead>
                                    <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                        <th class="p-0 pb-3 min-w-100px text-start">{{ __('FOLIO') }}</th>
                                        <th class="p-0 pb-3 min-w-150px text-start">{{ __('DEPENDENCIA') }}</th>
                                        <th class="p-0 pb-3 min-w-100px text-end pe-7">{{ __('ESTADO') }}</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">{{ __('RECEPCIÓN') }}</th>
                                        <th class="p-0 pb-3 w-50px text-end">{{ __('ACCIONES') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($denunciasActivas as $denuncia)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.denuncias.show', $denuncia->id_denuncia) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                                {{ $denuncia->folio_seguimiento }}
                                            </a>
                                        </td>
                                        <td>
                                            {{-- Usamos la relación circunstancia --}}
                                            <span class="text-gray-600 fw-semibold d-block fs-7">
                                                {{ $denuncia->circunstancia->dependencia_involucrada ?? 'N/D' }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-7">
                                            {{-- Leyenda de Estado con colores --}}
                                            @php
                                                $estadoId = $denuncia->id_estado;
                                                $colorClass = ($estadoId == 2) ? 'light-warning' : (($estadoId == 3) ? 'light-success' : 'light-secondary');
                                            @endphp
                                            <span class="badge badge-{{ $colorClass }}">
                                                {{ $denuncia->estado->nombre ?? 'N/D' }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-gray-600 fw-bold fs-6">{{ $denuncia->fecha_recepcion->format('d/M/Y') }}</span>
                                        </td>
                                        <td class="text-end">
                                            {{-- Enlace directo al detalle de la denuncia --}}
                                            <a href="{{ route('admin.denuncias.show', $denuncia->id_denuncia) }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                {!! getIcon('black-right', 'fs-2 text-gray-500') !!}
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">{{ __('Este usuario no tiene denuncias activas o turnadas actualmente.') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- FIN DE LA TABLA DINÁMICA --}}
                    </div>
                </div>
                    </div>
                    
                </div>
                
                <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
                    
                    {{-- Adaptación de la tabla de Sesiones de Login (Logs) --}}
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header border-0">
                            <div class="card-title"><h2>{{ __('Sesiones de Acceso') }}</h2></div>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-light-primary btn-sm" id="kt_modal_sign_out_sesions">{{ __('Cerrar todas las sesiones') }}</button>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                    <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                        <tr class="text-start text-muted text-uppercase gs-0">
                                            <th class="min-w-100px">{{ __('Ubicación') }}</th>
                                            <th>{{ __('Dispositivo') }}</th>
                                            <th>{{ __('Dirección IP') }}</th>
                                            <th class="min-w-125px">{{ __('Último Acceso') }}</th>
                                            <th class="min-w-70px">{{ __('Estado') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                        {{-- Mostrar sesiones activas (Datos simulados) --}}
                                        <tr>
                                            <td>Michoacán, México</td>
                                            <td>Chrome - Windows</td>
                                            <td>{{ request()->ip() }}</td>
                                            <td>{{ $user->last_login_at ? $user->last_login_at->format('d M Y, h:i a') : 'N/A' }}</td>
                                            <td><span class="badge badge-light-success">{{ __('Actual') }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    
    <!--end::Layout-->
    <!--begin::Modals-->
    <!--begin::Modal - Update user details-->
    @include('pages/apps/user-management/users/modals/_update-details')
    <!--end::Modal - Update user details-->
    <!--begin::Modal - Add schedule-->
    {{-- @include('pages/apps/user-management/users/modals/_add-schedule') --}}
    <!--end::Modal - Add schedule-->
    <!--begin::Modal - Add one time password-->
    {{-- @include('pages/apps/user-management/users/modals/_add-one-time-password') --}}
    <!--end::Modal - Add one time password-->
    <!--begin::Modal - Update email-->
    @include('pages/apps/user-management/users/modals/_update-email')
    <!--end::Modal - Update email-->
    <!--begin::Modal - Update password-->
    @include('pages/apps/user-management/users/modals/_update-password')
    <!--end::Modal - Update password-->
    <!--begin::Modal - Update role-->
    @include('pages/apps/user-management/users/modals/_update-role')
    <!--end::Modal - Update role-->
    <!--begin::Modal - Add auth app-->
    {{-- @include('pages/apps/user-management/users/modals/_add-auth-app') --}}
    <!--end::Modal - Add auth app-->
    <!--begin::Modal - Add task-->
    {{-- @include('pages/apps/user-management/users/modals/_add-task') --}}
    <!--end::Modal - Add task-->
    <!--end::Modals-->
</x-default-layout>
