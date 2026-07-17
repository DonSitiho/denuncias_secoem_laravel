<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante Oficial de Denuncia - {{ $denuncia->folio_seguimiento }}</title>
    <style>
        /* Estilos para el PDF - Versión Formal Granate */
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 12px;
            line-height: 1.4;
            color: #2D2D2D;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        /* Encabezado Oficial */
        .official-header {
            border-bottom: 4px double #6A0F49;
            padding: 25px 0;
            margin-bottom: 30px;
            text-align: center;
            background: linear-gradient(to bottom, #F8F6F7, #ffffff);
        }

        .government-title {
            font-size: 18px;
            font-weight: bold;
            color: #6A0F49;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .system-title {
            font-size: 14px;
            color: #7A1A59;
            font-weight: normal;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .document-title {
            font-size: 22px;
            font-weight: bold;
            color: #2D2D2D;
            text-transform: uppercase;
            margin: 20px 0;
            padding: 15px;
            border: 3px double #6A0F49;
            background-color: #F8F6F7;
            letter-spacing: 1px;
        }

        /* Folio Oficial */
        .official-folio {
            background: linear-gradient(135deg, #6A0F49, #8A2A69);
            color: white;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
            text-align: center;
            box-shadow: 0 6px 12px rgba(106, 15, 73, 0.2);
            border: 1px solid #5A0A39;
        }

        .folio-label {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
            opacity: 0.95;
            color: white;
        }

        .folio-number {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            color: white;
        }

        .folio-instruction {
            font-size: 11px;
            opacity: 0.9;
            margin-top: 10px;
            letter-spacing: 0.5px;
            color: white;
        }

        /* Secciones Oficiales */
        .official-section {
            margin-bottom: 30px;
            border: 1px solid #D1C4CC;
            border-radius: 6px;
            overflow: hidden;
            page-break-inside: avoid;
            box-shadow: 0 2px 4px rgba(106, 15, 73, 0.1);
        }

        .section-header {
            background: linear-gradient(135deg, #6A0F49, #7A1A59);
            color: #6A0F49;
            padding: 14px 18px;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #5A0A39;
        }

        .section-content {
            padding: 18px;
            background-color: #ffffff;
        }

        /* Grid de Información */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 12px;
        }

        .info-item {
            margin-bottom: 12px;
        }

        .info-label {
            font-weight: bold;
            color: #4A4A4A;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 0.4px;
            border-bottom: 1px dotted #D1C4CC;
            padding-bottom: 2px;
        }

        .info-value {
            padding: 10px 12px;
            background-color: #F8F6F7;
            border-radius: 4px;
            border-left: 4px solid #6A0F49;
            font-size: 11px;
            min-height: 20px;
            color: #2D2D2D;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        /* Tablas Oficiales */
        .official-table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 11px;
            box-shadow: 0 1px 3px rgba(106, 15, 73, 0.1);
        }

        .official-table th {
            background: linear-gradient(135deg, #6A0F49, #7A1A59);
            color: white !important;
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border: 1px solid #5A0A39;
            font-size: 10px;
        }

        .official-table td {
            padding: 10px;
            border: 1px solid #E5DDE2;
            vertical-align: top;
            background-color: #ffffff;
            color: #2D2D2D;
        }

        .official-table tr:nth-child(even) td {
            background-color: #F8F6F7;
        }

        .official-table tr:hover td {
            background-color: #F0ECEF;
        }

        /* Alertas y Notas Oficiales */
        .official-alert {
            padding: 15px 18px;
            border-radius: 6px;
            margin: 12px 0;
            border-left: 5px solid;
            font-size: 11px;
            background-color: #F8F6F7;
        }

        .alert-warning {
            border-left-color: #B36B00;
            background-color: #FFF8E6;
            color: #5A3D00;
        }

        .alert-info {
            border-left-color: #6A0F49;
            background-color: #F5EDF2;
            color: #4A0A32;
        }

        .alert-success {
            border-left-color: #2D5C2D;
            background-color: #F0F7F0;
            color: #1A3D1A;
        }

        /* QR Section */
        .qr-official {
            text-align: center;
            margin: 30px 0;
            padding: 25px;
            border: 2px solid #6A0F49;
            border-radius: 8px;
            background: linear-gradient(135deg, #F8F6F7, #ffffff);
            box-shadow: 0 4px 8px rgba(106, 15, 73, 0.1);
        }

        .qr-title {
            font-weight: bold;
            color: #6A0F49;
            margin-bottom: 12px;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.8px;
        }

        .qr-instruction {
            font-size: 10px;
            color: #7A7A7A;
            margin-top: 10px;
            line-height: 1.5;
        }

        /* Timestamp Oficial */
        .official-timestamp {
            text-align: right;
            font-size: 10px;
            color: #7A7A7A;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #E5DDE2;
            font-style: italic;
        }

        /* Footer Oficial */
        .official-footer {
            margin-top: 50px;
            padding-top: 25px;
            border-top: 4px double #6A0F49;
            font-size: 9px;
            color: #7A7A7A;
            text-align: center;
            background-color: #F8F6F7;
            padding: 20px;
        }

        .footer-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #6A0F49;
            letter-spacing: 0.8px;
        }

        .confidential-notice {
            font-style: italic;
            margin: 10px 0;
            color: #A52A2A;
            font-weight: bold;
        }

        /* Elementos de lista */
        .official-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .official-list li {
            padding: 6px 0;
            padding-left: 20px;
            position: relative;
            font-size: 11px;
        }

        .official-list li:before {
            content: "■";
            position: absolute;
            left: 0;
            color: #6A0F49;
            font-size: 8px;
            top: 8px;
        }

        /* Badges de Estado */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-anonymous {
            background-color: #F5EDF2;
            color: #6A0F49;
            border: 1px solid #D1C4CC;
        }

        .badge-identified {
            background-color: #E6F2E6;
            color: #2D5C2D;
            border: 1px solid #C4D8C4;
        }

        /* Utilidades */
        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mt-15 {
            margin-top: 15px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        /* Líneas divisorias decorativas */
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #D1C4CC, transparent);
            margin: 15px 0;
        }

        /* Estilo para texto importante */
        .important-text {
            color: #6A0F49;
            font-weight: bold;
        }

        /* Mejoras específicas para encabezados de tabla */
        .table-header-fix th {
            color: #6A0F49 !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .txt-ginda {
            color: #6A0F49;
        }

        .text-danger {
            color: #A52A2A;
        }
    </style>
</head>

<body>
    <!-- Timestamp Oficial -->
    <div class="official-timestamp">
        DOCUMENTO GENERADO EL: {{ $fechaActual }} | SISTEMA AUTOMATIZADO DE DENUNCIAS
    </div>

    <!-- Encabezado Oficial -->
    <!--
    <div class="official-header">
        <div class="government-title">GOBIERNO DEL ESTADO</div>
        <div class="system-title">SISTEMA INTEGRAL DE DENUNCIAS CIUDADANAS</div>
        <div class="document-title">COMPROBANTE OFICIAL DE DENUNCIA</div>
    </div>
    -->

    <div class="official-header">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="15%" align="center" valign="top">
                    <img src="{{ $logoMichoacan }}" style="height: 75px; width: auto;">
                </td>
                <td width="70%"></td>
                <td width="15%" align="center" valign="top">
                    <img src="{{ $logoSecoem }}" style="height: 75px; width: auto;">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <div class="government-title">GOBIERNO DEL ESTADO</div>
                    <div class="system-title">SISTEMA INTEGRAL DE DENUNCIAS CIUDADANAS</div>
                    <div class="document-title">COMPROBANTE OFICIAL DE DENUNCIA</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Folio Oficial -->
    <div class="official-folio">
        <div class="folio-label txt-ginda">NÚMERO DE FOLIO DE SEGUIMIENTO</div>
        <div class="folio-number txt-ginda">{{ $denuncia->folio_seguimiento }}</div>
        <div class="folio-label txt-ginda">CÓDIGO DE VERIFICACIÓN</div>
        <div class="folio-number text-danger">{{ $denuncia->token_validacion }}</div>

        <div class="folio-instruction txt-ginda">
            CONSERVE ESTOS DATOS PARA CONSULTAR EL ESTADO DE SU TRÁMITE
        </div>
    </div>

    <!-- Información General -->
    <div class="official-section">
        <div class="section-header txt-ginda">INFORMACIÓN GENERAL DEL EXPEDIENTE</div>
        <div class="section-content">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Número de Folio</div>
                    <div class="info-value">{{ $denuncia->folio_seguimiento }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Fecha y Hora de Registro</div>
                    <div class="info-value">{{ $denuncia->fecha_recepcion->format('d/m/Y H:i') }} HRS</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tipo de Denuncia</div>
                    <div class="info-value">
                        @if ($denuncia->es_anonima)
                            <span class="status-badge badge-anonymous">DENUNCIA ANÓNIMA</span>
                        @else
                            <span class="status-badge badge-identified">DENUNCIA CON IDENTIFICACIÓN</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Estatus del Trámite</div>
                    <div class="info-value">REGISTRADA Y EN PROCESO</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datos del Denunciante -->
    @if ($datosContactoDenunciante)
        <div class="official-section">
            <div class="section-header ">INFORMACIÓN DEL DENUNCIANTE</div>
            <div class="section-content">
                @if ($denuncia->es_anonima)
                    <div class="official-alert alert-warning">
                        <strong>DECLARACIÓN BAJO PROTECCIÓN DE IDENTIDAD</strong><br>
                        Esta denuncia ha sido registrada bajo el protocolo de protección de identidad del denunciante,
                        de acuerdo con lo establecido en el artículo correspondiente de la Ley de Protección al
                        Denunciante.
                    </div>
                @else
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nombre Completo</div>
                            <div class="info-value">{{ $datosContactoDenunciante->nombre_completo }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Teléfono de Contacto</div>
                            <div class="info-value">{{ $datosContactoDenunciante->telefono }}</div>
                        </div>
                        <div class="info-item full-width">
                            <div class="info-label">Correo Electrónico</div>
                            <div class="info-value">{{ $datosContactoDenunciante->correo_electronico }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Hechos Denunciados -->
    <div class="official-section">
        <div class="section-header">DESCRIPCIÓN DE LOS HECHOS DENUNCIADOS</div>
        <div class="section-content">
            <div class="info-item full-width mb-10">
                <div class="info-label">Motivo Principal de la Denuncia</div>
                <div class="info-value" style="min-height: 50px; font-style: italic;">{{ $denuncia->motivo_denuncia }}
                </div>
            </div>

            <div class="divider"></div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Fecha de los Hechos</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($denuncia->fecha_hechos)->format('d/m/Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Hora Aproximada</div>
                    <div class="info-value">{{ $datosCircunstancia->hora_hechos ?? 'NO ESPECIFICADA' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Municipio</div>
                    <div class="info-value">{{ $datosMunicipio->nombre_municipio ?? 'NO ESPECIFICADO' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Localidad/Colonia</div>
                    <div class="info-value">{{ $datosCircunstancia->localidad ?? 'NO ESPECIFICADA' }}</div>
                </div>
            </div>

            <div class="info-item full-width mt-15">
                <div class="info-label">Ubicación Exacta de los Hechos</div>
                <div class="info-value">{{ $datosCircunstancia->direccion_exacta }}</div>
            </div>

            @if ($datosCircunstancia->dependencia_involucrada)
                <div class="info-item full-width mt-15">
                    <div class="info-label">Dependencia Gubernamental Involucrada</div>
                    <div class="info-value">{{ $datosCircunstancia->dependencia_involucrada }}</div>
                </div>
            @endif

            @if ($datosCircunstancia->tramite_solicitado)
                <div class="info-item full-width mt-15">
                    <div class="info-label">Trámite o Servicio Solicitado</div>
                    <div class="info-value">{{ $datosCircunstancia->tramite_solicitado }}</div>
                </div>
            @endif

            @if ($datosCircunstancia->circunstancias_detalladas)
                <div class="info-item full-width mt-15">
                    <div class="info-label">Relato Detallado de los Hechos</div>
                    <div class="info-value" style="min-height: 100px; line-height: 1.6;">
                        {{ $datosCircunstancia->circunstancias_detalladas }}</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Personas Involucradas - Versión Tabular -->
    @if ($datosDenunciaInvolucrado && $datosDenunciaInvolucrado->count() > 0)
        <div class="official-section">
            <div class="section-header">REGISTRO DE PERSONAS INVOLUCRADAS</div>
            <div class="section-content">

                <!-- Tabla de Involucrados -->
                <div style="margin-bottom: 25px;">
                    <div class="info-label" style="margin-bottom: 12px; font-size: 12px; color: #6A0F49;">PERSONAL
                        DENUNCIADO</div>
                    <table class="official-table table-header-fix">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Puesto/Cargo</th>
                                <th>Edad Aprox.</th>
                                <th>Descripción Física</th>
                                <th>Señas Particulares</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datosDenunciaInvolucrado as $involucrado)
                                <tr>
                                    <td><strong>{{ $involucrado->nombre_denunciado ?? 'INFORMACIÓN NO PROPORCIONADA' }}</strong>
                                    </td>
                                    <td>{{ $involucrado->puesto_denunciado ?? 'NO ESPECIFICADO' }}</td>
                                    <td>{{ $involucrado->edad_aprox ?? 'NO ESPECIFICADA' }}</td>
                                    <td>
                                        {{ $involucrado->tipo_tez ?? '' }} {{ $involucrado->estatura_aprox ?? '' }}
                                        {{ $involucrado->complexion ?? '' }} {{ $involucrado->color_ojo ?? '' }}
                                        {{ $involucrado->tipo_cabello ?? '' }}
                                        @if ($involucrado->descripcion_fisica)
                                            <br><em>{{ $involucrado->descripcion_fisica }}</em>
                                        @endif
                                    </td>
                                    <td>{{ $involucrado->senas_particulares ?? 'NINGUNA REGISTRADA' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Tabla de Testigos -->
                @if ($datosTestigos && $datosTestigos->count() > 0)
                    <div>
                        <div class="info-label" style="margin-bottom: 12px; font-size: 12px; color: #6A0F49;">TESTIGOS
                            IDENTIFICADOS</div>
                        <table class="official-table table-header-fix">
                            <thead>
                                <tr>
                                    <th>NOMBRE DEL TESTIGO</th>
                                    <th>DATOS DE CONTACTO</th>
                                    <th>OBSERVACIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datosTestigos as $testigo)
                                    <tr>
                                        <td><strong>{{ $testigo->nombre_testigo ?? 'TESTIGO NO IDENTIFICADO' }}</strong>
                                        </td>
                                        <td>{{ $testigo->datos_contacto ?? 'CONTACTO NO PROPORCIONADO' }}</td>
                                        <td>{{ $testigo->observaciones ?? 'SIN OBSERVACIONES ADICIONALES' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    @endif

    <!-- Código QR para Seguimiento -->
    <div class="qr-official">
        <div class="qr-title">SISTEMA DE SEGUIMIENTO EN LÍNEA</div>
        <img src="data:image/png;base64,{{ $qrCode }}" alt="Código QR de Seguimiento"
            style="width: 120px; height: 120px;">
        <div class="qr-instruction">
            ESCANEE ESTE CÓDIGO CON SU DISPOSITIVO MÓVIL PARA CONSULTAR<br>
            EL ESTADO ACTUALIZADO DE SU DENUNCIA LAS 24 HORAS
        </div>
    </div>

    <!-- Información de Contacto Oficial -->
    {{-- <div class="official-section">
        <div class="section-header">CANALES OFICIALES DE CONTACTO</div>
        <div class="section-content">
            <div class="official-alert alert-info">
                <strong>INFORMACIÓN DE CONTACTO OFICIAL</strong><br><br>
                Para consultas sobre el estado de su denuncia, puede utilizar los siguientes canales oficiales:<br><br>
                <ul class="official-list">
                    <li><strong>Línea de Atención Ciudadana:</strong> 01-800-XXX-XXXX</li>
                    <li><strong>Correo Electrónico Oficial:</strong> denuncias@ejemplo.gob.mx</li>
                    <li><strong>Portal Web Oficial:</strong> www.denuncias.ejemplo.gob.mx</li>
                    <li><strong>Oficinas Centrales:</strong> Av. Principal #123, Centro, Ciudad</li>
                    <li><strong>Horario de Atención:</strong> Lunes a Viernes de 9:00 a 18:00 Hrs</li>
                </ul>
            </div>
        </div>
    </div> --}}

    <!-- Pie de Página Oficial -->
    <div class="official-footer">
        <div class="footer-title">Sistema Integral de Denuncias Ciudadanas</div>
        <div class="confidential-notice">
            ESTE DOCUMENTO ES DE CARÁCTER OFICIAL Y CONFIDENCIAL - SU INFORMACIÓN ESTÁ PROTEGIDA BAJO LA LEY FEDERAL DE
            PROTECCIÓN DE DATOS PERSONALES
        </div>
        <div style="margin: 10px 0;">
            Folio Oficial: <strong>{{ $denuncia->folio_seguimiento }}</strong> |
            Fecha de Emisión: <strong>{{ $fechaActual }}</strong> |
            Código de Verificación: <strong>{{ $denuncia->token_validacion }}</strong>
        </div>
        <div>
            © {{ date('Y') }} Gobierno del Estado. Todos los derechos reservados.
        </div>
    </div>
</body>

</html>
