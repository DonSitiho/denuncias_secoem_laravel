<x-default-layout>
    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <!--begin::Row-->
    <div class="row gy-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-4 mb-xl-10">
            <div class="card card-flush h-xl-10">
                <!--begin::Heading-->
                <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                    style="background-image:url('/assets/media/auth/bg15.png" dat-bs-theme="light">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column text-white pt-15">
                        <span class="fw-bold fs-2x mb-3">
                            <font dir="auto" style="vertical-align: inherit;">
                                <font dir="auto" style="vertical-align: inherit;">Mis Denuncias</font>
                            </font>
                        </span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Body-->
                <div class="card-body mt-n20">
                    <!--begin::Stats-->
                    <div class="mt-n20 position-relative">
                        <!--begin::Row-->
                        <div class="row g-3 g-lg-6">
                            <!--begin::Col-->
                            <div class="col-6"  data-bs-toggle="modal" data-bs-target="#kt_modal_view_denuncias_area">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">{{ $totalDenunciasArea
                                                    }}</font>
                                            </font>
                                        </span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">Area</font>
                                            </font>
                                        </span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_view_denuncias_anonimas">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">{{
                                                    $totalDenunciasAnonimas }}</font>
                                            </font>
                                        </span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">Anonimas</font>
                                            </font>
                                        </span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_view_denuncias_tramite">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">{{
                                                    $totalDenunciasTurnadaResponsable }}</font>
                                            </font>
                                        </span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">En tramite</font>
                                            </font>
                                        </span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->


                            <!--begin::Col-->
                            <div class="col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_view_denuncias_noAnonimas">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">{{
                                                    $totalDenunciasNoAnonimas }}</font>
                                            </font>
                                        </span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">No Anonimas</font>
                                            </font>
                                        </span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_view_denuncias_terminadas">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">{{
                                                    $totalDTR }}</font>
                                            </font>
                                        </span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">Terminadas</font>
                                            </font>
                                        </span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_view_denuncias">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">{{
                                                    $totalDenuncias }}</font>
                                            </font>
                                        </span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">
                                            <font dir="auto" style="vertical-align: inherit;">
                                                <font dir="auto" style="vertical-align: inherit;">Total</font>
                                            </font>
                                        </span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        <!--end::Col-->

        {{-- Contenedor de las gráficas estáticas --}}
        <!--begin::Col-->
        <div class="col-xl-8">
            @include('partials/widgets/oic_denuncias/_widget-18')
        </div>
        <!--end::Col-->

    </div>
    <!--end::Row-->

    @include('pages.dashboards.partials.modal_denuncias_dashboard')
</x-default-layout>