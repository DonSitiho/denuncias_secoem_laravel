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
                    style="background-image:url('/assets/media/auth/bg15.png"
                    dat-bs-theme="light">
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
                            <div class="col-6">
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
                            <div class="col-6">
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
                            <div class="col-6">
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
                            <div class="col-6">
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

        <!--begin::Col-->
        <div class="col-xl-8">
            <!--begin::Chart widget 18-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Learn Activity</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Hours per course</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_18_chart" class="h-325px w-100 min-h-auto ps-4 pe-6"
                        style="min-height: 340px;">
                        <div id="apexchartsq06b6tzeg"
                            class="apexcharts-canvas apexchartsq06b6tzeg apexcharts-theme-light"
                            style="width: 631px; height: 325px;"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" class="apexcharts-svg"
                                xmlns:data="ApexChartsNS" transform="translate(0, 0)" width="631" height="325">
                                <foreignObject x="0" y="0" width="631" height="325">
                                    <style type="text/css">
                                        .apexcharts-flip-y {
                                            transform: scaleY(-1) translateY(-100%);
                                            transform-origin: top;
                                            transform-box: fill-box;
                                        }

                                        .apexcharts-flip-x {
                                            transform: scaleX(-1);
                                            transform-origin: center;
                                            transform-box: fill-box;
                                        }

                                        .apexcharts-legend {
                                            display: flex;
                                            overflow: auto;
                                            padding: 0 10px;
                                        }

                                        .apexcharts-legend.apexcharts-legend-group-horizontal {
                                            flex-direction: column;
                                        }

                                        .apexcharts-legend-group {
                                            display: flex;
                                        }

                                        .apexcharts-legend-group-vertical {
                                            flex-direction: column-reverse;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom,
                                        .apexcharts-legend.apx-legend-position-top {
                                            flex-wrap: wrap
                                        }

                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            flex-direction: column;
                                            bottom: 0;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                                        .apexcharts-legend.apx-legend-position-right,
                                        .apexcharts-legend.apx-legend-position-left {
                                            justify-content: flex-start;
                                            align-items: flex-start;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                            justify-content: center;
                                            align-items: center;
                                        }

                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                            justify-content: flex-end;
                                            align-items: flex-end;
                                        }

                                        .apexcharts-legend-series {
                                            cursor: pointer;
                                            line-height: normal;
                                            display: flex;
                                            align-items: center;
                                        }

                                        .apexcharts-legend-text {
                                            position: relative;
                                            font-size: 14px;
                                        }

                                        .apexcharts-legend-text *,
                                        .apexcharts-legend-marker * {
                                            pointer-events: none;
                                        }

                                        .apexcharts-legend-marker {
                                            position: relative;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            cursor: pointer;
                                            margin-right: 1px;
                                        }

                                        .apexcharts-legend-series.apexcharts-no-click {
                                            cursor: auto;
                                        }

                                        .apexcharts-legend .apexcharts-hidden-zero-series,
                                        .apexcharts-legend .apexcharts-hidden-null-series {
                                            display: none !important;
                                        }

                                        .apexcharts-inactive-legend {
                                            opacity: 0.45;
                                        }
                                    </style>
                                </foreignObject>
                                <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g>
                                <g class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"></g>
                                <g class="apexcharts-yaxis" rel="0" transform="translate(28.078125, 0)">
                                    <g class="apexcharts-yaxis-texts-g"><text x="20" y="34.333333333333336"
                                            text-anchor="end" dominant-baseline="auto" font-size="13px"
                                            font-family="inherit" font-weight="400" fill="#99a1b7"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: inherit;">
                                            <tspan>120H</tspan>
                                            <title>120H</title>
                                        </text><text x="20" y="64.8177277560764" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px" font-family="inherit"
                                            font-weight="400" fill="#99a1b7"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: inherit;">
                                            <tspan>100H</tspan>
                                            <title>100H</title>
                                        </text><text x="20" y="95.30212217881945" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px" font-family="inherit"
                                            font-weight="400" fill="#99a1b7"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: inherit;">
                                            <tspan>80H</tspan>
                                            <title>80H</title>
                                        </text><text x="20" y="125.7865166015625" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px" font-family="inherit"
                                            font-weight="400" fill="#99a1b7"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: inherit;">
                                            <tspan>60H</tspan>
                                            <title>60H</title>
                                        </text><text x="20" y="156.27091102430555" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px" font-family="inherit"
                                            font-weight="400" fill="#99a1b7"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: inherit;">
                                            <tspan>40H</tspan>
                                            <title>40H</title>
                                        </text><text x="20" y="186.7553054470486" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px" font-family="inherit"
                                            font-weight="400" fill="#99a1b7"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: inherit;">
                                            <tspan>20H</tspan>
                                            <title>20H</title>
                                        </text><text x="20" y="217.23969986979168" text-anchor="end"
                                            dominant-baseline="auto" font-size="13px" font-family="inherit"
                                            font-weight="400" fill="#99a1b7"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: inherit;">
                                            <tspan>0H</tspan>
                                            <title>0H</title>
                                        </text></g>
                                </g>
                                <g class="apexcharts-inner apexcharts-graphical" transform="translate(58.078125, 30)">
                                    <defs>
                                        <linearGradient x1="0" y1="0" x2="0" y2="1" id="SvgjsLinearGradient1023">
                                            <stop stop-opacity="0" stop-color="rgba(216,227,240,0)" offset="0"></stop>
                                            <stop stop-opacity="0" stop-color="rgba(190,209,230,0)" offset="1"></stop>
                                            <stop stop-opacity="0" stop-color="rgba(190,209,230,0)" offset="1"></stop>
                                        </linearGradient>
                                        <clipPath id="gridRectMaskq06b6tzeg">
                                            <rect width="568.921875" height="188.90636653645834" x="-3" y="-3" rx="0"
                                                ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="gridRectBarMaskq06b6tzeg">
                                            <rect width="568.921875" height="188.90636653645834" x="-3" y="-3" rx="0"
                                                ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="gridRectMarkerMaskq06b6tzeg">
                                            <rect width="568.921875" height="182.90636653645834" x="-3" y="0" rx="0"
                                                ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fff"></rect>
                                        </clipPath>
                                        <clipPath id="forecastMaskq06b6tzeg"></clipPath>
                                        <clipPath id="nonForecastMaskq06b6tzeg"></clipPath>
                                    </defs>
                                    <rect width="22.516875" height="182.90636653645834" x="187.58258989606583" y="0"
                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="#b6b6b6" stroke-dasharray="3"
                                        fill="url(#SvgjsLinearGradient1023)" class="apexcharts-xcrosshairs"
                                        y2="182.90636653645834" filter="none" fill-opacity="0.9" x1="187.58258989606583"
                                        x2="187.58258989606583"></rect>
                                    <g class="apexcharts-grid">
                                        <g class="apexcharts-gridlines-horizontal">
                                            <line x1="0" y1="30.484394422743055" x2="562.921875" y2="30.484394422743055"
                                                stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                            <line x1="0" y1="60.96878884548611" x2="562.921875" y2="60.96878884548611"
                                                stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                            <line x1="0" y1="91.45318326822917" x2="562.921875" y2="91.45318326822917"
                                                stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                            <line x1="0" y1="121.93757769097222" x2="562.921875" y2="121.93757769097222"
                                                stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                            <line x1="0" y1="152.42197211371527" x2="562.921875" y2="152.42197211371527"
                                                stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt"
                                                class="apexcharts-gridline"></line>
                                        </g>
                                        <g class="apexcharts-gridlines-vertical"></g>
                                        <line x1="0" y1="182.90636653645834" x2="562.921875" y2="182.90636653645834"
                                            stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                        <line x1="0" y1="1" x2="0" y2="182.90636653645834" stroke="transparent"
                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                    </g>
                                    <g class="apexcharts-grid-borders">
                                        <line x1="0" y1="0" x2="562.921875" y2="0" stroke="#dbdfe9" stroke-dasharray="4"
                                            stroke-linecap="butt" class="apexcharts-gridline"></line>
                                        <line x1="0" y1="182.90636653645834" x2="562.921875" y2="182.90636653645834"
                                            stroke="#dbdfe9" stroke-dasharray="4" stroke-linecap="butt"
                                            class="apexcharts-gridline"></line>
                                    </g>
                                    <g class="apexcharts-bar-series apexcharts-plot-series">
                                        <g class="apexcharts-series" rel="1" seriesName="Spentxtime" data:realIndex="0">
                                            <path
                                                d="M 29.950267857142855 176.90736653645834 L 29.950267857142855 106.59950159505209 C 29.950267857142855 104.09950159505209 32.450267857142855 101.59950159505209 34.950267857142855 101.59950159505209 L 45.46714285714285 101.59950159505209 C 47.96714285714285 101.59950159505209 50.46714285714285 104.09950159505209 50.46714285714285 106.59950159505209 L 50.46714285714285 176.90736653645834 C 50.46714285714285 179.40736653645834 47.96714285714285 181.90736653645834 45.46714285714285 181.90736653645834 L 34.950267857142855 181.90736653645834 C 32.450267857142855 181.90736653645834 29.950267857142855 179.40736653645834 29.950267857142855 176.90736653645834 Z "
                                                fill="rgba(27,132,255,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="square" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMaskq06b6tzeg)"
                                                pathTo="M 29.950267857142855 176.90736653645834 L 29.950267857142855 106.59950159505209 C 29.950267857142855 104.09950159505209 32.450267857142855 101.59950159505209 34.950267857142855 101.59950159505209 L 45.46714285714285 101.59950159505209 C 47.96714285714285 101.59950159505209 50.46714285714285 104.09950159505209 50.46714285714285 106.59950159505209 L 50.46714285714285 176.90736653645834 C 50.46714285714285 179.40736653645834 47.96714285714285 181.90736653645834 45.46714285714285 181.90736653645834 L 34.950267857142855 181.90736653645834 C 32.450267857142855 181.90736653645834 29.950267857142855 179.40736653645834 29.950267857142855 176.90736653645834 Z "
                                                pathFrom="M 29.950267857142855 181.90736653645834 L 29.950267857142855 181.90736653645834 L 50.46714285714285 181.90736653645834 L 50.46714285714285 181.90736653645834 L 50.46714285714285 181.90736653645834 L 50.46714285714285 181.90736653645834 L 50.46714285714285 181.90736653645834 L 29.950267857142855 181.90736653645834 Z"
                                                cy="100.59850159505208" cx="108.36767857142857" j="0" val="54"
                                                barHeight="82.30786494140625" barWidth="22.516875"></path>
                                            <path
                                                d="M 110.36767857142857 176.90736653645834 L 110.36767857142857 124.89013824869792 C 110.36767857142857 122.39013824869792 112.86767857142857 119.89013824869792 115.36767857142857 119.89013824869792 L 125.88455357142857 119.89013824869792 C 128.38455357142857 119.89013824869792 130.88455357142857 122.39013824869792 130.88455357142857 124.89013824869792 L 130.88455357142857 176.90736653645834 C 130.88455357142857 179.40736653645834 128.38455357142857 181.90736653645834 125.88455357142857 181.90736653645834 L 115.36767857142857 181.90736653645834 C 112.86767857142857 181.90736653645834 110.36767857142857 179.40736653645834 110.36767857142857 176.90736653645834 Z "
                                                fill="rgba(27,132,255,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="square" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMaskq06b6tzeg)"
                                                pathTo="M 110.36767857142857 176.90736653645834 L 110.36767857142857 124.89013824869792 C 110.36767857142857 122.39013824869792 112.86767857142857 119.89013824869792 115.36767857142857 119.89013824869792 L 125.88455357142857 119.89013824869792 C 128.38455357142857 119.89013824869792 130.88455357142857 122.39013824869792 130.88455357142857 124.89013824869792 L 130.88455357142857 176.90736653645834 C 130.88455357142857 179.40736653645834 128.38455357142857 181.90736653645834 125.88455357142857 181.90736653645834 L 115.36767857142857 181.90736653645834 C 112.86767857142857 181.90736653645834 110.36767857142857 179.40736653645834 110.36767857142857 176.90736653645834 Z "
                                                pathFrom="M 110.36767857142857 181.90736653645834 L 110.36767857142857 181.90736653645834 L 130.88455357142857 181.90736653645834 L 130.88455357142857 181.90736653645834 L 130.88455357142857 181.90736653645834 L 130.88455357142857 181.90736653645834 L 130.88455357142857 181.90736653645834 L 110.36767857142857 181.90736653645834 Z"
                                                cy="118.88913824869792" cx="188.78508928571426" j="1" val="42"
                                                barHeight="64.01722828776042" barWidth="22.516875"></path>
                                            <path
                                                d="M 190.78508928571426 176.90736653645834 L 190.78508928571426 74.59088745117188 C 190.78508928571426 72.09088745117188 193.28508928571426 69.59088745117188 195.78508928571426 69.59088745117188 L 206.30196428571426 69.59088745117188 C 208.80196428571426 69.59088745117188 211.30196428571426 72.09088745117188 211.30196428571426 74.59088745117188 L 211.30196428571426 176.90736653645834 C 211.30196428571426 179.40736653645834 208.80196428571426 181.90736653645834 206.30196428571426 181.90736653645834 L 195.78508928571426 181.90736653645834 C 193.28508928571426 181.90736653645834 190.78508928571426 179.40736653645834 190.78508928571426 176.90736653645834 Z "
                                                fill="rgba(27,132,255,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="square" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMaskq06b6tzeg)"
                                                pathTo="M 190.78508928571426 176.90736653645834 L 190.78508928571426 74.59088745117188 C 190.78508928571426 72.09088745117188 193.28508928571426 69.59088745117188 195.78508928571426 69.59088745117188 L 206.30196428571426 69.59088745117188 C 208.80196428571426 69.59088745117188 211.30196428571426 72.09088745117188 211.30196428571426 74.59088745117188 L 211.30196428571426 176.90736653645834 C 211.30196428571426 179.40736653645834 208.80196428571426 181.90736653645834 206.30196428571426 181.90736653645834 L 195.78508928571426 181.90736653645834 C 193.28508928571426 181.90736653645834 190.78508928571426 179.40736653645834 190.78508928571426 176.90736653645834 Z "
                                                pathFrom="M 190.78508928571426 181.90736653645834 L 190.78508928571426 181.90736653645834 L 211.30196428571426 181.90736653645834 L 211.30196428571426 181.90736653645834 L 211.30196428571426 181.90736653645834 L 211.30196428571426 181.90736653645834 L 211.30196428571426 181.90736653645834 L 190.78508928571426 181.90736653645834 Z"
                                                cy="68.58988745117188" cx="269.2025" j="2" val="75"
                                                barHeight="114.31647908528646" barWidth="22.516875"></path>
                                            <path
                                                d="M 271.2025 176.90736653645834 L 271.2025 21.24319721137152 C 271.2025 18.74319721137152 273.7025 16.24319721137152 276.2025 16.24319721137152 L 286.719375 16.24319721137152 C 289.219375 16.24319721137152 291.719375 18.74319721137152 291.719375 21.24319721137152 L 291.719375 176.90736653645834 C 291.719375 179.40736653645834 289.219375 181.90736653645834 286.719375 181.90736653645834 L 276.2025 181.90736653645834 C 273.7025 181.90736653645834 271.2025 179.40736653645834 271.2025 176.90736653645834 Z "
                                                fill="rgba(27,132,255,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="square" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMaskq06b6tzeg)"
                                                pathTo="M 271.2025 176.90736653645834 L 271.2025 21.24319721137152 C 271.2025 18.74319721137152 273.7025 16.24319721137152 276.2025 16.24319721137152 L 286.719375 16.24319721137152 C 289.219375 16.24319721137152 291.719375 18.74319721137152 291.719375 21.24319721137152 L 291.719375 176.90736653645834 C 291.719375 179.40736653645834 289.219375 181.90736653645834 286.719375 181.90736653645834 L 276.2025 181.90736653645834 C 273.7025 181.90736653645834 271.2025 179.40736653645834 271.2025 176.90736653645834 Z "
                                                pathFrom="M 271.2025 181.90736653645834 L 271.2025 181.90736653645834 L 291.719375 181.90736653645834 L 291.719375 181.90736653645834 L 291.719375 181.90736653645834 L 291.719375 181.90736653645834 L 291.719375 181.90736653645834 L 271.2025 181.90736653645834 Z"
                                                cy="15.242197211371519" cx="349.6199107142857" j="3" val="110"
                                                barHeight="167.66416932508682" barWidth="22.516875"></path>
                                            <path
                                                d="M 351.6199107142857 176.90736653645834 L 351.6199107142857 153.85031295030382 C 351.6199107142857 151.35031295030382 354.1199107142857 148.85031295030382 356.6199107142857 148.85031295030382 L 367.1367857142857 148.85031295030382 C 369.6367857142857 148.85031295030382 372.1367857142857 151.35031295030382 372.1367857142857 153.85031295030382 L 372.1367857142857 176.90736653645834 C 372.1367857142857 179.40736653645834 369.6367857142857 181.90736653645834 367.1367857142857 181.90736653645834 L 356.6199107142857 181.90736653645834 C 354.1199107142857 181.90736653645834 351.6199107142857 179.40736653645834 351.6199107142857 176.90736653645834 Z "
                                                fill="rgba(27,132,255,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="square" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMaskq06b6tzeg)"
                                                pathTo="M 351.6199107142857 176.90736653645834 L 351.6199107142857 153.85031295030382 C 351.6199107142857 151.35031295030382 354.1199107142857 148.85031295030382 356.6199107142857 148.85031295030382 L 367.1367857142857 148.85031295030382 C 369.6367857142857 148.85031295030382 372.1367857142857 151.35031295030382 372.1367857142857 153.85031295030382 L 372.1367857142857 176.90736653645834 C 372.1367857142857 179.40736653645834 369.6367857142857 181.90736653645834 367.1367857142857 181.90736653645834 L 356.6199107142857 181.90736653645834 C 354.1199107142857 181.90736653645834 351.6199107142857 179.40736653645834 351.6199107142857 176.90736653645834 Z "
                                                pathFrom="M 351.6199107142857 181.90736653645834 L 351.6199107142857 181.90736653645834 L 372.1367857142857 181.90736653645834 L 372.1367857142857 181.90736653645834 L 372.1367857142857 181.90736653645834 L 372.1367857142857 181.90736653645834 L 372.1367857142857 181.90736653645834 L 351.6199107142857 181.90736653645834 Z"
                                                cy="147.8493129503038" cx="430.03732142857143" j="4" val="23"
                                                barHeight="35.05705358615452" barWidth="22.516875"></path>
                                            <path
                                                d="M 432.03732142857143 176.90736653645834 L 432.03732142857143 56.30025079752604 C 432.03732142857143 53.80025079752604 434.53732142857143 51.30025079752604 437.03732142857143 51.30025079752604 L 447.55419642857146 51.30025079752604 C 450.05419642857146 51.30025079752604 452.55419642857146 53.80025079752604 452.55419642857146 56.30025079752604 L 452.55419642857146 176.90736653645834 C 452.55419642857146 179.40736653645834 450.05419642857146 181.90736653645834 447.55419642857146 181.90736653645834 L 437.03732142857143 181.90736653645834 C 434.53732142857143 181.90736653645834 432.03732142857143 179.40736653645834 432.03732142857143 176.90736653645834 Z "
                                                fill="rgba(27,132,255,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="square" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMaskq06b6tzeg)"
                                                pathTo="M 432.03732142857143 176.90736653645834 L 432.03732142857143 56.30025079752604 C 432.03732142857143 53.80025079752604 434.53732142857143 51.30025079752604 437.03732142857143 51.30025079752604 L 447.55419642857146 51.30025079752604 C 450.05419642857146 51.30025079752604 452.55419642857146 53.80025079752604 452.55419642857146 56.30025079752604 L 452.55419642857146 176.90736653645834 C 452.55419642857146 179.40736653645834 450.05419642857146 181.90736653645834 447.55419642857146 181.90736653645834 L 437.03732142857143 181.90736653645834 C 434.53732142857143 181.90736653645834 432.03732142857143 179.40736653645834 432.03732142857143 176.90736653645834 Z "
                                                pathFrom="M 432.03732142857143 181.90736653645834 L 432.03732142857143 181.90736653645834 L 452.55419642857146 181.90736653645834 L 452.55419642857146 181.90736653645834 L 452.55419642857146 181.90736653645834 L 452.55419642857146 181.90736653645834 L 452.55419642857146 181.90736653645834 L 432.03732142857143 181.90736653645834 Z"
                                                cy="50.29925079752604" cx="510.45473214285715" j="5" val="87"
                                                barHeight="132.6071157389323" barWidth="22.516875"></path>
                                            <path
                                                d="M 512.4547321428572 176.90736653645834 L 512.4547321428572 112.69638047960069 C 512.4547321428572 110.19638047960069 514.9547321428572 107.69638047960069 517.4547321428572 107.69638047960069 L 527.9716071428571 107.69638047960069 C 530.4716071428571 107.69638047960069 532.9716071428571 110.19638047960069 532.9716071428571 112.69638047960069 L 532.9716071428571 176.90736653645834 C 532.9716071428571 179.40736653645834 530.4716071428571 181.90736653645834 527.9716071428571 181.90736653645834 L 517.4547321428572 181.90736653645834 C 514.9547321428572 181.90736653645834 512.4547321428572 179.40736653645834 512.4547321428572 176.90736653645834 Z "
                                                fill="rgba(27,132,255,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="square" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area undefined" index="0"
                                                clip-path="url(#gridRectBarMaskq06b6tzeg)"
                                                pathTo="M 512.4547321428572 176.90736653645834 L 512.4547321428572 112.69638047960069 C 512.4547321428572 110.19638047960069 514.9547321428572 107.69638047960069 517.4547321428572 107.69638047960069 L 527.9716071428571 107.69638047960069 C 530.4716071428571 107.69638047960069 532.9716071428571 110.19638047960069 532.9716071428571 112.69638047960069 L 532.9716071428571 176.90736653645834 C 532.9716071428571 179.40736653645834 530.4716071428571 181.90736653645834 527.9716071428571 181.90736653645834 L 517.4547321428572 181.90736653645834 C 514.9547321428572 181.90736653645834 512.4547321428572 179.40736653645834 512.4547321428572 176.90736653645834 Z "
                                                pathFrom="M 512.4547321428572 181.90736653645834 L 512.4547321428572 181.90736653645834 L 532.9716071428571 181.90736653645834 L 532.9716071428571 181.90736653645834 L 532.9716071428571 181.90736653645834 L 532.9716071428571 181.90736653645834 L 532.9716071428571 181.90736653645834 L 512.4547321428572 181.90736653645834 Z"
                                                cy="106.69538047960069" cx="590.8721428571429" j="6" val="50"
                                                barHeight="76.21098605685765" barWidth="22.516875"></path>
                                            <g class="apexcharts-bar-goals-markers">
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMaskq06b6tzeg)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMaskq06b6tzeg)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMaskq06b6tzeg)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMaskq06b6tzeg)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMaskq06b6tzeg)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMaskq06b6tzeg)"></g>
                                                <g className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMaskq06b6tzeg)"></g>
                                            </g>
                                            <g class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g>
                                        </g>
                                        <g class="apexcharts-datalabels apexcharts-hidden-element-shown"
                                            data:realIndex="0">
                                            <g class="apexcharts-data-labels" transform="rotate(0)"><text
                                                    x="39.20870535714286" y="88.59850159505208" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                    font-weight="600" fill="#071437" class="apexcharts-datalabel"
                                                    cx="39.20870535714286" cy="88.59850159505208"
                                                    style="font-family: inherit;">54</text></g>
                                            <g class="apexcharts-data-labels" transform="rotate(0)"><text
                                                    x="119.62611607142856" y="106.88913824869792" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                    font-weight="600" fill="#071437" class="apexcharts-datalabel"
                                                    cx="119.62611607142856" cy="106.88913824869792"
                                                    style="font-family: inherit;">42</text></g>
                                            <g class="apexcharts-data-labels" transform="rotate(0)"><text
                                                    x="200.04352678571428" y="56.589887451171876" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                    font-weight="600" fill="#071437" class="apexcharts-datalabel"
                                                    cx="200.04352678571428" cy="56.589887451171876"
                                                    style="font-family: inherit;">75</text></g>
                                            <g class="apexcharts-data-labels" transform="rotate(0)"><text
                                                    x="280.4609375" y="3.2421972113715185" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                    font-weight="600" fill="#071437" class="apexcharts-datalabel"
                                                    cx="280.4609375" cy="3.2421972113715185"
                                                    style="font-family: inherit;">110</text></g>
                                            <g class="apexcharts-data-labels" transform="rotate(0)"><text
                                                    x="360.8783482142857" y="135.8493129503038" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                    font-weight="600" fill="#071437" class="apexcharts-datalabel"
                                                    cx="360.8783482142857" cy="135.8493129503038"
                                                    style="font-family: inherit;">23</text></g>
                                            <g class="apexcharts-data-labels" transform="rotate(0)"><text
                                                    x="441.29575892857144" y="38.29925079752604" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                    font-weight="600" fill="#071437" class="apexcharts-datalabel"
                                                    cx="441.29575892857144" cy="38.29925079752604"
                                                    style="font-family: inherit;">87</text></g>
                                            <g class="apexcharts-data-labels" transform="rotate(0)"><text
                                                    x="521.7131696428571" y="94.69538047960069" text-anchor="middle"
                                                    dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                    font-weight="600" fill="#071437" class="apexcharts-datalabel"
                                                    cx="521.7131696428571" cy="94.69538047960069"
                                                    style="font-family: inherit;">50</text></g>
                                        </g>
                                    </g>
                                    <line x1="0" y1="0" x2="562.921875" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                        stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                    <line x1="0" y1="0" x2="562.921875" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                        stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                    </line>
                                    <g class="apexcharts-xaxis" transform="translate(0, 0)">
                                        <g class="apexcharts-xaxis-texts-g" transform="translate(0, -10)"><text
                                                x="40.208705357142854" y="204.90636653645834" text-anchor="end"
                                                dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                font-weight="400" fill="#99a1b7"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                transform="rotate(-45 41.274131774902344 198.9063720703125)"
                                                style="font-family: inherit;">
                                                <tspan>QA Analysis</tspan>
                                                <title>QA Analysis</title>
                                            </text><text x="120.62611607142856" y="204.90636653645834" text-anchor="end"
                                                dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                font-weight="400" fill="#99a1b7"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                transform="rotate(-45 121.63563537597656 198.9063720703125)"
                                                style="font-family: inherit;">
                                                <tspan>Marketing</tspan>
                                                <title>Marketing</title>
                                            </text><text x="201.04352678571425" y="204.90636653645834" text-anchor="end"
                                                dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                font-weight="400" fill="#99a1b7"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                transform="rotate(-45 202.38973999023438 198.9063720703125)"
                                                style="font-family: inherit;">
                                                <tspan>Web Dev</tspan>
                                                <title>Web Dev</title>
                                            </text><text x="281.4609375" y="204.90636653645834" text-anchor="end"
                                                dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                font-weight="400" fill="#99a1b7"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                transform="rotate(-45 282.522705078125 198.9063720703125)"
                                                style="font-family: inherit;">
                                                <tspan>Maths</tspan>
                                                <title>Maths</title>
                                            </text><text x="361.8783482142857" y="204.90636653645834" text-anchor="end"
                                                dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                font-weight="400" fill="#99a1b7"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                transform="rotate(-45 363.21868896484375 198.9063720703125)"
                                                style="font-family: inherit;">
                                                <tspan>Front-end Dev</tspan>
                                                <title>Front-end Dev</title>
                                            </text><text x="442.29575892857144" y="204.90636653645834" text-anchor="end"
                                                dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                font-weight="400" fill="#99a1b7"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                transform="rotate(-45 443.3638610839844 198.9063720703125)"
                                                style="font-family: inherit;">
                                                <tspan>Physics</tspan>
                                                <title>Physics</title>
                                            </text><text x="522.7131696428571" y="204.90636653645834" text-anchor="end"
                                                dominant-baseline="auto" font-size="13px" font-family="inherit"
                                                font-weight="400" fill="#99a1b7"
                                                class="apexcharts-text apexcharts-xaxis-label "
                                                transform="rotate(-45 524.0525512695312 198.9063720703125)"
                                                style="font-family: inherit;">
                                                <tspan>Phylosophy</tspan>
                                                <title>Phylosophy</title>
                                            </text></g>
                                    </g>
                                    <g class="apexcharts-yaxis-annotations"></g>
                                    <g class="apexcharts-xaxis-annotations"></g>
                                    <g class="apexcharts-point-annotations"></g>
                                </g>
                            </svg>
                            <div class="apexcharts-legend" style="max-height: 162.5px;"></div>
                            <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 256.919px; top: 64px;">
                                <div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;">Web
                                    Dev</div>
                                <div class="apexcharts-tooltip-series-group apexcharts-tooltip-series-group-0 apexcharts-active"
                                    style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker"
                                        shape="circle" style="color: rgb(27, 132, 255);"></span>
                                    <div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;">
                                        <div class="apexcharts-tooltip-y-group"><span
                                                class="apexcharts-tooltip-text-y-label">Spent time: </span><span
                                                class="apexcharts-tooltip-text-y-value">75 hours</span></div>
                                        <div class="apexcharts-tooltip-goals-group"><span
                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                        <div class="apexcharts-tooltip-z-group"><span
                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                <div class="apexcharts-yaxistooltip-text"></div>
                            </div>
                        </div>
                    </div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 18-->
        </div>
        <!--end::Col-->


    </div>
    <!--end::Row-->
</x-default-layout>