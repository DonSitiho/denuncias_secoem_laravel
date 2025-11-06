<div class="card card-flush h-xl-100">
	<div class="card-header pt-5">
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">{{ __('Porcentaje de Atención') }}</span>
			<span class="text-gray-500 mt-1 fw-semibold fs-6">{{ __('Top 5 de Áreas y Usuarios con más denuncias asignadas.') }}</span>
		</h3>
		<div class="card-toolbar d-flex align-items-center">
            <span class="fs-7 fw-bold text-gray-600 me-3">{{ __('Estados:') }}</span>
			
            <div class="d-flex align-items-center me-3">
                <span class="w-10px h-10px rounded-circle bg-warning me-1"></span>
                <span class="fs-7 text-gray-600 fw-semibold">{{ __('Turnadas') }}</span>
            </div>
            
            <div class="d-flex align-items-center me-3">
                <span class="w-10px h-10px rounded-circle bg-success me-1"></span>
                <span class="fs-7 text-gray-600 fw-semibold">{{ __('En Trámite') }}</span>
            </div>
            
            <div class="d-flex align-items-center">
                <span class="w-10px h-10px rounded-circle bg-danger me-1"></span>
                <span class="fs-7 text-gray-600 fw-semibold">{{ __('Cerradas') }}</span>
            </div>
		</div>
		</div>
	<div class="card-body pt-6">
		<ul class="nav nav-pills nav-pills-custom mb-3">
			
			{{-- Pestaña 1: ÁREAS --}}
			<li class="nav-item mb-3 me-3 me-lg-6">
				<a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-100px h-85px pt-5 pb-2 active" id="kt_stats_widget_16_tab_link_1" data-bs-toggle="pill" href="#tab_areas">
					<div class="nav-icon mb-3">{!! getIcon('setting-3', 'fs-1') !!}</div>
					<span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('Áreas') }}</span>
					<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
				</a>
			</li>
			
			{{-- Pestaña 2: USUARIOS --}}
			<li class="nav-item mb-3 me-3 me-lg-6">
				<a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-100px h-85px pt-5 pb-2" id="kt_stats_widget_16_tab_link_2" data-bs-toggle="pill" href="#tab_usuarios">
					<div class="nav-icon mb-3">{!! getIcon('user', 'fs-1') !!}</div>
					<span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('Usuarios') }}</span>
					<span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
				</a>
			</li>

		</ul>
		<div class="tab-content">
			
			{{-- ========================================================================= --}}
			{{-- TAP PANE 1: ÁREAS (TABLA) --}}
			{{-- ========================================================================= --}}
			<div class="tab-pane fade show active" id="tab_areas">
				<div class="table-responsive">
					<table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
						<thead>
							<tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
								<th class="p-0 pb-3 min-w-180px text-start">{{ __('ÁREA') }}</th>
								<th class="p-0 pb-3 min-w-100px text-end pe-13">{{ __('TOTAL') }}</th>
								<th class="p-0 pb-3 min-w-120px text-end pe-7">{{ __('ESTATUS') }}</th>
								<th class="p-0 pb-3 w-50px text-end"></th>
							</tr>
						</thead>
						<tbody>
							@forelse($areaData as $area)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div class="d-flex justify-content-start flex-column">
											<a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
												[{{ $area['area_siglas'] }}] {{ $area['area_name'] }}
											</a>
										</div>
									</div>
								</td>
								<td class="text-end pe-13">
									<span class="text-gray-600 fw-bold fs-6">{{ $area['denuncias_total'] }}</span>
								</td>
								<td class="text-end pe-7">
									{{-- Leyenda: Naranja (Turnadas), Verde (Trámite), Rojo/Morado (Cerradas) --}}
									<span class="badge badge-light-warning me-2" title="Turnadas">{{ $area['turnadas'] }}</span>
									<span class="badge badge-light-success me-2" title="En Trámite">{{ $area['tramite'] }}</span>
									<span class="badge badge-light-danger" title="Cerradas">{{ $area['cerradas'] }}</span>
								</td>
								<td class="text-end">
									<a href="{{ route('admin.denuncias.index', ['area' => $area['area_siglas']]) }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">{!! getIcon('black-right', 'fs-2 text-gray-500') !!}</a>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="4" class="text-center text-muted">{{ __('No hay datos de desempeño de áreas.') }}</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
			
			{{-- ========================================================================= --}}
			{{-- TAP PANE 2: USUARIOS (TABLA) --}}
			{{-- ========================================================================= --}}
			<div class="tab-pane fade" id="tab_usuarios">
				<div class="table-responsive">
					<table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
						<thead>
							<tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
								<th class="p-0 pb-3 min-w-150px text-start">{{ __('USUARIO') }}</th>
								<th class="p-0 pb-3 min-w-100px text-end pe-13">{{ __('TOTAL') }}</th>
								<th class="p-0 pb-3 min-w-120px text-end pe-7">{{ __('ESTATUS') }}</th>
								<th class="p-0 pb-3 w-50px text-end"></th>
							</tr>
						</thead>
						<tbody>
							@forelse($userData as $user)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div class="d-flex justify-content-start flex-column">
											<a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
												{{ $user['user_name'] }}
											</a>
											<span class="text-gray-500 fw-semibold d-block fs-7">{{ $user['user_email'] }}</span>
										</div>
									</div>
								</td>
								<td class="text-end pe-13">
									<span class="text-gray-600 fw-bold fs-6">{{ $user['denuncias_total'] }}</span>
								</td>
								<td class="text-end pe-7">
									{{-- Leyenda: Naranja (Turnadas), Verde (Trámite), Rojo/Morado (Cerradas) --}}
									<span class="badge badge-light-warning me-2" title="Turnadas">{{ $user['turnadas'] }}</span>
									<span class="badge badge-light-success me-2" title="En Trámite">{{ $user['tramite'] }}</span>
									<span class="badge badge-light-danger" title="Cerradas">{{ $user['cerradas'] }}</span>
								</td>
								<td class="text-end">
									<a href="{{ route('admin.denuncias.index', ['responsable' => $user['user_email']]) }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">{!! getIcon('black-right', 'fs-2 text-gray-500') !!}</a>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="4" class="text-center text-muted">{{ __('No hay datos de desempeño de usuarios.') }}</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
		</div>
	</div>