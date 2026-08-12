<!-- Modal para visualizar las denuncias por area -->
<div class="modal fade" id="kt_modal_view_denuncias_area" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">{!! getIcon('cross', 'fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Lista de Denunicas Por Area</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        Si necesitas obtener mas informacion, dale click a una denuncia.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Users-->
                <div class="mb-15">
                    <!--begin::List-->

                    <div class="mh-375px scroll-y me-n7 pe-7">
                        @foreach ($denunciasArea->take(5) as $denuncia)
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Details-->
                                    <div class="ms-6">

                                        @if ($denuncia->id_responsable == 3 || $denuncia->id_area_responsable == 3)
                                            <!--begin::Name-->
                                            <a href="{{ route('uaoic.show', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @else
                                            <!--begin::Name-->
                                            <a href="{{ route('oic.ver-denuncia', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @endif
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">
                                            {{ $denuncia->fecha_recepcion->format('d/m/Y
                                                                                                                                                                                                                                                                    H:i') }}
                                        </div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">

                                        <div class="fs-5 fw-bold text-gray-900">
                                            <span class="badge badge-lg badge-light-success me-3 fs-6">
                                                {{ $denuncia->areaResponsable->siglas }}
                                            </span>
                                        </div>
                                        <div class="fs-7 text-muted">{{ $denuncia->areaResponsable->nombre_area }}</div>

                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                        @endforeach
                    </div>

                    <!--end::List-->
                </div>
                <!--end::Users-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Modal para visualizar las denuncias por area-->


<!-- Modal para visualizar las denuncias en tramite -->
<div class="modal fade" id="kt_modal_view_denuncias_tramite" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}</div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Lista de Denunicas en Tramite</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        Si necesitas obtener mas informacion, dale click a una denuncia.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Users-->
                <div class="mb-15">
                    <!--begin::List-->

                    <div class="mh-375px scroll-y me-n7 pe-7">
                        @foreach ($denunciasTramite->take(5) as $denuncia)
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Details-->
                                    <div class="ms-6">

                                        @if ($denuncia->id_responsable == 3 ||  $denuncia->id_area_responsable == 3)
                                            <!--begin::Name-->
                                            <a href="{{ route('uaoic.show', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @else
                                            <!--begin::Name-->
                                            <a href="{{ route('oic.ver-denuncia', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @endif
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">
                                            {{ $denuncia->fecha_recepcion->format('d/m/Y
                                                                                                                                                                                                                                                                    H:i') }}
                                        </div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">
                                            <span class="badge badge-lg badge-light-warning me-3 fs-6">
                                                Estado: {{ $denuncia->estado->nombre }}
                                            </span>
                                        </div>

                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                        @endforeach
                    </div>

                    <!--end::List-->
                </div>
                <!--end::Users-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Modal para visualizar las denuncias en tramite-->


<!-- Modal para visualizar las denuncias terminadas -->
<div class="modal fade" id="kt_modal_view_denuncias_terminadas" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}</div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Lista de Denunicas Cerradas</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        Si necesitas obtener mas informacion, dale click a una denuncia.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Users-->
                <div class="mb-15">
                    <!--begin::List-->

                    <div class="mh-375px scroll-y me-n7 pe-7">
                        @foreach ($denunciasTerminadas->take(5) as $denuncia)
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Details-->
                                    <div class="ms-6">

                                        @if ($denuncia->id_responsable == 3 ||  $denuncia->id_area_responsable == 3)
                                            <!--begin::Name-->
                                            <a href="{{ route('uaoic.show', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @else
                                            <!--begin::Name-->
                                            <a href="{{ route('oic.ver-denuncia', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @endif

                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">
                                            {{ $denuncia->fecha_recepcion->format('d/m/Y
                                                                                                                                                                                                                                                                    H:i') }}
                                        </div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">
                                            <span class="badge badge-lg badge-light-success me-3 fs-6">
                                                Estado: {{ $denuncia->estado->nombre }}
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                        @endforeach
                    </div>

                    <!--end::List-->
                </div>
                <!--end::Users-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Modal para visualizar las denuncias en tramite-->


<!-- Modal para visualizar las denuncias anonimas -->
<div class="modal fade" id="kt_modal_view_denuncias_anonimas" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}</div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Lista de Denunicas Anonimas</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        Si necesitas obtener mas informacion, dale click a una denuncia.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Users-->
                <div class="mb-15">
                    <!--begin::List-->

                    <div class="mh-375px scroll-y me-n7 pe-7">
                        @foreach ($denunciasAnonimas->take(5) as $denuncia)
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Details-->
                                    <div class="ms-6">

                                        @if ($denuncia->id_responsable == 3 ||  $denuncia->id_area_responsable == 3)
                                            <!--begin::Name-->
                                            <a href="{{ route('uaoic.show', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @else
                                            <!--begin::Name-->
                                            <a href="{{ route('oic.ver-denuncia', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @endif

                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">
                                            {{ $denuncia->fecha_recepcion->format('d/m/Y
                                                                                                                                                                                                                                                                    H:i') }}
                                        </div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">
                                            @if ($denuncia->es_anonima)
                                                <span
                                                    class="badge badge-light-danger me-3 fs-6">{{ __('Anónima') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                        @endforeach
                    </div>

                    <!--end::List-->
                </div>
                <!--end::Users-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Modal para visualizar las denuncias anonimas-->

<!-- Modal para visualizar las denuncias no anonimas -->
<div class="modal fade" id="kt_modal_view_denuncias_noAnonimas" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}</div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Lista de Denunicas No Anonimas</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        Si necesitas obtener mas informacion, dale click a una denuncia.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Users-->
                <div class="mb-15">
                    <!--begin::List-->

                    <div class="mh-375px scroll-y me-n7 pe-7">
                        @foreach ($denunciasNoAnonimas->take(5) as $denuncia)
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Details-->
                                    <div class="ms-6">

                                        @if ($denuncia->id_responsable == 3 ||  $denuncia->id_area_responsable == 3)
                                            <!--begin::Name-->
                                            <a href="{{ route('uaoic.show', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @else
                                            <!--begin::Name-->
                                            <a href="{{ route('oic.ver-denuncia', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @endif
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">
                                            {{ $denuncia->fecha_recepcion->format('d/m/Y
                                                                                                                                                                                                                                                                    H:i') }}
                                        </div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        @if (!$denuncia->es_anonima)
                                            <div class="fs-5 fw-bold text-gray-900">
                                                {{ $denuncia->contacto->nombre_completo }}
                                            </div>
                                            <div class="fs-7 text-muted">{{ $denuncia->contacto->correo_electronico }}
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                        @endforeach
                    </div>

                    <!--end::List-->
                </div>
                <!--end::Users-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Modal para visualizar las denuncias anonimas-->


<!-- Modal para visualizar las denuncias -->
<div class="modal fade" id="kt_modal_view_denuncias" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    {!! getIcon('cross', 'fs-1') !!}</div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Lista de Denunicas Turnadas</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-semibold fs-5">
                        Si necesitas obtener mas informacion, dale click a una denuncia.
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Users-->
                <div class="mb-15">
                    <!--begin::List-->

                    <div class="mh-375px scroll-y me-n7 pe-7">
                        @foreach ($denunciasTurnadas->take(5) as $denuncia)
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Details-->
                                    <div class="ms-6">

                                        @if ($denuncia->id_responsable == 3 ||  $denuncia->id_area_responsable == 3)
                                            <!--begin::Name-->
                                            <a href="{{ route('uaoic.show', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @else
                                            <!--begin::Name-->
                                            <a href="{{ route('oic.ver-denuncia', $denuncia->id_denuncia) }}"
                                                class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">
                                                {{ $denuncia->folio_seguimiento }}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                            <!--end::Name-->
                                        @endif
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted">
                                            {{ $denuncia->fecha_recepcion->format('d/m/Y
                                                                                                                                                                                                                                                                    H:i') }}
                                        </div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-gray-900">

                                            @if ($denuncia->id_estado === 2)
                                                <span class="badge badge-lg badge-light-primary me-3 fs-6">
                                                    {{ $denuncia->estado->nombre }}
                                                </span>
                                            @elseif ($denuncia->id_estado === 3)
                                                <span class="badge badge-lg badge-light-warning me-3 fs-6">
                                                    {{ $denuncia->estado->nombre }}
                                                </span>
                                            @elseif ($denuncia->id_estado === 4)
                                                <span class="badge badge-lg badge-light-success me-3 fs-6">
                                                    {{ $denuncia->estado->nombre }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->
                        @endforeach
                    </div>

                    <!--end::List-->
                </div>
                <!--end::Users-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Modal para visualizar las denuncias anonimas-->
