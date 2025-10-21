<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Denuncia - {{ $denuncia->folio }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #333;
            margin: 0;
        }
        .folio {
            font-size: 18px;
            font-weight: bold;
            color: #2c5aa0;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 5px;
            font-weight: bold;
            border-left: 3px solid #2c5aa0;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .col-6 {
            flex: 0 0 50%;
            padding: 0 10px;
            box-sizing: border-box;
        }
        .col-12 {
            flex: 0 0 100%;
            padding: 0 10px;
            box-sizing: border-box;
        }
        .label {
            font-weight: bold;
            margin-bottom: 2px;
        }
        .value {
            margin-bottom: 8px;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comprobante de Denuncia</h1>
        <p class="folio">Folio: {{ $denuncia->folio }}</p>
        <p>Fecha de generación: {{ $fecha }}</p>
    </div>

    <div class="section">
        <div class="section-title">Información General</div>
        <div class="row">
            <div class="col-6">
                <div class="label">Folio:</div>
                <div class="value">{{ $denuncia->folio }}</div>
            </div>
            <div class="col-6">
                <div class="label">Fecha de Registro:</div>
                <div class="value">{{ $denuncia->created_at->format('d/m/Y H:i') }}</div>
            </div>
            <div class="col-6">
                <div class="label">Estado:</div>
                <div class="value">{{ $denuncia->estado }}</div>
            </div>
            <div class="col-6">
                <div class="label">Tipo de Denuncia:</div>
                <div class="value">
                    @if($denuncia->es_anonima)
                        Anónima
                    @else
                        Con identificación
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!$denuncia->es_anonima)
    <div class="section">
        <div class="section-title">Datos del Denunciante</div>
        <div class="row">
            <div class="col-6">
                <div class="label">Nombre completo:</div>
                <div class="value">{{ $denuncia->nombre_completo }}</div>
            </div>
            <div class="col-6">
                <div class="label">Teléfono:</div>
                <div class="value">{{ $denuncia->telefono }}</div>
            </div>
            <div class="col-6">
                <div class="label">Correo electrónico:</div>
                <div class="value">{{ $denuncia->correo_electronico }}</div>
            </div>
        </div>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Hechos Denunciados</div>
        <div class="row">
            <div class="col-12">
                <div class="label">Motivo de la denuncia:</div>
                <div class="value">{{ $denuncia->motivo_denuncia }}</div>
            </div>
            <div class="col-6">
                <div class="label">Fecha de los hechos:</div>
                <div class="value">{{ \Carbon\Carbon::parse($denuncia->fecha_hechos)->format('d/m/Y') }}</div>
            </div>
            <div class="col-6">
                <div class="label">Hora de los hechos:</div>
                <div class="value">{{ $denuncia->hora_hechos ?? 'No especificada' }}</div>
            </div>
            <div class="col-6">
                <div class="label">Municipio:</div>
                <div class="value">{{ $denuncia->municipio->nombre ?? 'No especificado' }}</div>
            </div>
            <div class="col-6">
                <div class="label">Dirección exacta:</div>
                <div class="value">{{ $denuncia->direccion_exacta }}</div>
            </div>
            <div class="col-6">
                <div class="label">Localidad:</div>
                <div class="value">{{ $denuncia->localidad ?? 'No especificada' }}</div>
            </div>
            @if($denuncia->dependencia_involucrada)
            <div class="col-6">
                <div class="label">Dependencia involucrada:</div>
                <div class="value">{{ $denuncia->dependencia_involucrada }}</div>
            </div>
            @endif
            @if($denuncia->tramite_solicitado)
            <div class="col-6">
                <div class="label">Trámite solicitado:</div>
                <div class="value">{{ $denuncia->tramite_solicitado }}</div>
            </div>
            @endif
            @if($denuncia->circunstancias_detalladas)
            <div class="col-12">
                <div class="label">Circunstancias detalladas:</div>
                <div class="value">{{ $denuncia->circunstancias_detalladas }}</div>
            </div>
            @endif
        </div>
    </div>

    @if($denuncia->involucrados || $denuncia->testigos)
    <div class="section">
        <div class="section-title">Personas Involucradas</div>
        <div class="row">
            @if($denuncia->involucrados)
            <div class="col-6">
                <div class="label">Involucrados:</div>
                <div class="value">
                    @foreach(json_decode($denuncia->involucrados) as $involucrado)
                        • {{ $involucrado }}<br>
                    @endforeach
                </div>
            </div>
            @endif
            @if($denuncia->testigos)
            <div class="col-6">
                <div class="label">Testigos:</div>
                <div class="value">
                    @foreach(json_decode($denuncia->testigos) as $testigo)
                        • {{ $testigo }}<br>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Código de Seguimiento</div>
        <div class="qr-code">
            <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code" width="150">
            <p>Escanea este código QR para consultar el estatus de tu denuncia</p>
        </div>
    </div>

    <div class="footer">
        <p>Este documento es un comprobante de la denuncia registrada en el sistema.</p>
        <p>Para consultas, visite nuestro sitio web o acuda a las oficinas correspondientes.</p>
    </div>
</body>
</html>