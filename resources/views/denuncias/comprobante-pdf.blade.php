<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Denuncia - {{ $denuncia->folio_seguimiento }}</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #2c5aa0;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #2c5aa0;
            margin: 0;
            font-size: 24px;
        }

        .header .subtitle {
            color: #666;
            font-size: 14px;
            margin: 5px 0;
        }

        .folio-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }

        .folio-number {
            font-size: 20px;
            font-weight: bold;
            color: #2c5aa0;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section-title {
            background-color: #2c5aa0;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
        }

        .info-item {
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
            color: #555;
            margin-bottom: 2px;
        }

        .value {
            padding: 5px;
            background-color: #f8f9fa;
            border-radius: 3px;
            border-left: 3px solid #2c5aa0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .qr-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            border: 2px dashed #ddd;
            border-radius: 5px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        .alert {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 3px;
            padding: 10px;
            margin: 10px 0;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeaa7;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .timestamp {
            text-align: right;
            font-size: 10px;
            color: #666;
            margin-bottom: 10px;
        }

        /* Estilos para listas */
        .list-item {
            margin-bottom: 3px;
            padding-left: 15px;
            position: relative;
        }

        .list-item:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2c5aa0;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Timestamp -->
    <div class="timestamp">
        Generado el: {{ $fechaActual }}
    </div>

    <!-- Encabezado -->
    <div class="header">
        <h1>COMPROBANTE DE DENUNCIA</h1>
        <div class="subtitle">Sistema de Denuncias Ciudadanas</div>
    </div>

    <!-- Sección del Folio -->
    <div class="folio-section">
        <div class="label">NÚMERO DE FOLIO</div>
        <div class="folio-number">{{ $denuncia->folio_seguimiento }}</div>
        <div style="margin-top: 5px; font-size: 11px; color: #666;">
            Utilice este folio para consultar el estado de su denuncia
        </div>
    </div>

    <!-- Información General -->
    <div class="section">
        <div class="section-title">INFORMACIÓN GENERAL</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="label">Folio</div>
                <div class="value">{{ $denuncia->folio_seguimiento }}</div>
            </div>
            <div class="info-item">
                <div class="label">Fecha de Registro</div>
                <div class="value">{{ $denuncia->fecha_recepcion->format('d/m/Y H:i') }}</div>
            </div>
            {{-- <div class="info-item">
                <div class="label">Estado Actual</div>
                <div class="value">{{ $denuncia->estado }}</div>
            </div> --}}
            <div class="info-item">
                <div class="label">Tipo de Denuncia</div>
                <div class="value">
                    @if ($denuncia->es_anonima)
                        <strong>ANÓNIMA</strong>
                    @else
                        CON IDENTIFICACIÓN
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Datos del Denunciante -->

    @if ($datosContactoDenunciante)
        <div class="section">
            <div class="section-title">DATOS DEL DENUNCIANTE</div>
            @if ($denuncia->es_anonima)
                <div class="alert alert-warning">
                    <strong>DENUNCIA ANÓNIMA</strong><br>
                    Esta denuncia fue registrada de forma anónima. No se cuenta con información de contacto del
                    denunciante.
                </div>
            @else
                <div class="info-grid">
                    <div class="info-item">
                        <div class="label">Nombre completo</div>
                        <div class="value">{{ $datosContactoDenunciante->nombre_completo }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Teléfono</div>
                        <div class="value">{{ $datosContactoDenunciante->telefono }}</div>
                    </div>
                    <div class="info-item full-width">
                        <div class="label">Correo electrónico</div>
                        <div class="value">{{ $datosContactoDenunciante->correo_electronico }}</div>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Hechos Denunciados -->
    <div class="section">
        <div class="section-title">HECHOS DENUNCIADOS</div>

        <div class="info-item full-width">
            <div class="label">Motivo de la denuncia</div>
            <div class="value" style="min-height: 40px;">{{ $denuncia->motivo_denuncia }}</div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="label">Fecha de los hechos</div>
                <div class="value">{{ \Carbon\Carbon::parse($denuncia->fecha_hechos)->format('d/m/Y') }}</div>
            </div>
            <div class="info-item">
                <div class="label">Hora de los hechos</div>
                <div class="value">{{ $datosCircunstancia->hora_hechos ?? 'No especificada' }}</div>
            </div>
            <div class="info-item">
                <div class="label">Municipio</div>
                <div class="value">{{ $datosMunicipio->nombre_municipio ?? 'No especificado' }}</div>
            </div>
            <div class="info-item">
                <div class="label">Localidad</div>
                <div class="value">{{ $datosCircunstancia->localidad ?? 'No especificada' }}</div>
            </div>
        </div>

        <div class="info-item full-width">
            <div class="label">Dirección exacta</div>
            <div class="value">{{ $datosCircunstancia->direccion_exacta }}</div>
        </div>

        @if ($datosCircunstancia->dependencia_involucrada)
            <div class="info-item full-width">
                <div class="label">Dependencia involucrada</div>
                <div class="value">{{ $datosCircunstancia->dependencia_involucrada }}</div>
            </div>
        @endif

        @if ($datosCircunstancia->tramite_solicitado)
            <div class="info-item full-width">
                <div class="label">Trámite solicitado</div>
                <div class="value">{{ $datosCircunstancia->tramite_solicitado }}</div>
            </div>
        @endif

        @if ($datosCircunstancia->circunstancias_detalladas)
            <div class="info-item full-width">
                <div class="label">Circunstancias detalladas</div>
                <div class="value" style="min-height: 80px;">{{ $datosCircunstancia->circunstancias_detalladas }}
                </div>
            </div>
        @endif
    </div>

    <!-- Personas Involucradas -->
    <!-- Personas Involucradas -->
    @if ($datosDenunciaInvolucrado && $datosDenunciaInvolucrado->count() > 0)
        <div class="section">
            <div class="section-title">PERSONAS INVOLUCRADAS</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="label">Involucrados</div>
                    <div class="value">
                        @foreach ($datosDenunciaInvolucrado as $involucrado)
                            <p>Nombre: {{ $involucrado->nombre_denunciado ?? 'Sin nombre' }}</p>
                            <p>Tipo: {{ $involucrado->tipo_involucrado ?? 'Sin tipo' }}</p>
                            <p>Documento: {{ $involucrado->documento_identidad ?? 'Sin documento' }}</p>
                            <p>Teléfono: {{ $involucrado->telefono ?? 'Sin teléfono' }}</p>
                            <p>Correo: {{ $involucrado->correo_electronico ?? 'Sin correo' }}</p>
                            <hr>
                        @endforeach
                    </div>
                </div>

                @if ($datosTestigos && $datosTestigos->count() > 0)
                    <div class="info-item">
                        <div class="label">Testigos</div>
                        <div class="value">
                            @foreach ($datosTestigos as $testigo)
                                <p>Nombre: {{ $testigo->nombre_testigo ?? 'Sin nombre' }}</p>
                                <p>Documento: {{ $testigo->documento_identidad ?? 'Sin documento' }}</p>
                                <p>Teléfono: {{ $testigo->telefono ?? 'Sin teléfono' }}</p>
                                <p>Correo: {{ $testigo->correo_electronico ?? 'Sin correo' }}</p>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif


    <!-- Código QR para Seguimiento -->
    <div class="section">
        <div class="qr-section">
            <div style="margin-bottom: 10px;">
                <strong>CONSULTA EL ESTADO DE TU DENUNCIA</strong>
            </div>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 120px; height: 120px;">
            <div style="margin-top: 10px; font-size: 10px; color: #666;">
                Escanee este código QR para consultar el estado de su denuncia
            </div>
        </div>
    </div>

    <!-- Información de Contacto -->
    <div class="section">
        <div class="alert alert-info">
            <strong>INFORMACIÓN DE CONTACTO</strong><br>
            Para cualquier consulta sobre el estado de su denuncia, puede contactarnos a través de:<br>
            • Teléfono: [Número de contacto]<br>
            • Correo electrónico: [correo@ejemplo.com]<br>
            • Página web: [www.ejemplo.com]
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p><strong>Sistema de Denuncias Ciudadanas</strong></p>
        <p>Este documento es un comprobante oficial de la denuncia registrada en nuestro sistema.</p>
        <p>La información contenida en este documento es confidencial y está protegida por la ley.</p>
        <p>Folio: {{ $denuncia->folio_seguimiento }} | Generado el: {{ $fechaActual }}</p>
    </div>
</body>

</html>
