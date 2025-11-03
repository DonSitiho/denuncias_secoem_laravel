<a href="{{ $link ?? '#' }}" class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" 
   style="background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}'); background-color: {{ $color ?? '#009EF7' }};">
	
	<div class="card-header pt-5">
		<div class="card-title d-flex flex-column">
			<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $count }}</span>
			<span class="text-white opacity-75 pt-1 fw-semibold fs-6">{{ $title }}</span>
			</div>
		</div>
	<div class="card-body d-flex align-items-end pt-0">
        <div class="d-flex align-items-center flex-column mt-3 w-100">
            <div class="text-white opacity-75 fw-semibold fs-7 mb-2">
                {{ $subtitle ?? __('Haga clic para ver los detalles.') }}
            </div>
            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;"></div>
            </div>
        </div>
	</div>
	</a>