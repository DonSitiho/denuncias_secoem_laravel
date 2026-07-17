<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Expediente {{ $denuncia->folio_seguimiento }}</title>
    {{-- Estilos mínimos, DomPDF maneja CSS de forma básica. --}}
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 16pt;
            color: #6A0F49;
        }

        .section-title {
            font-size: 12pt;
            margin-top: 15px;
            margin-bottom: 8px;
            padding: 5px;
            background-color: #f0f0f0;
            border-left: 5px solid #1e88e5;
        }

        .data-row {
            margin-bottom: 5px;
        }

        .data-row strong {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        .details-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 15px;
        }

        .badge {
            background-color: #ff9800;
            color: white;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 8pt;
        }
    </style>
</head>

<body>

    <!--
   
    -->
    <div class="header">
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
                    <h1>Secretaría de Contraloría del Estado de Michoacán</h1>
                    <h2>Expediente de Denuncia SECOEM</h2>
                    <p><strong>Folio Único:</strong> {{ $denuncia->folio_seguimiento }} |
                        <strong>Recepción:</strong> {{ $denuncia->fecha_recepcion->format('d/m/Y H:i') }} |
                        <strong>Estado:</strong> {{ $denuncia->estado->nombre ?? 'N/D' }}
                    </p>
                </td>
            </tr>
        </table>
    </div>
    {{-- ========================================================================= --}}
    {{-- 1. DETALLES DE HECHOS --}}
    {{-- ========================================================================= --}}
    <div class="section-title">DETALLES DE CIRCUNSTANCIAS Y MOTIVO</div>
    <div class="details-box">
        <p class="data-row"><strong>Fecha de Hechos:</strong>
            {{ $denuncia->circunstancia->fecha_hechos->format('d/m/Y') ?? 'N/A' }}
            ({{ $denuncia->circunstancia->hora_hechos ?? 'Sin hora' }})</p>
        <p class="data-row"><strong>Ubicación:</strong>
            {{ $denuncia->circunstancia->municipio->nombre_municipio ?? 'N/A' }},
            {{ $denuncia->circunstancia->localidad ?? 'N/A' }}</p>
        <p class="data-row"><strong>Dirección Exacta:</strong>
            {{ $denuncia->circunstancia->direccion_exacta ?? 'N/A' }}</p>
        <p class="data-row"><strong>Dependencia Señalada:</strong>
            {{ $denuncia->circunstancia->dependencia_involucrada ?? 'N/A' }}</p>
        <p class="data-row"><strong>Trámite Relacionado:</strong>
            {{ $denuncia->circunstancia->tramite_solicitado ?? 'N/A' }}</p>
        <p style="margin-top: 10px;"><strong>Motivo de la Denuncia:</strong> {{ $denuncia->motivo_denuncia }}</p>
        <p style="margin-top: 10px;"><strong>Circunstancias Detalladas:</strong>
            {{ $denuncia->circunstancia->circunstancias_detalladas ?? 'Sin detalle adicional' }}</p>
    </div>

    {{-- ========================================================================= --}}
    {{-- 2. PERSONAS INVOLUCRADAS --}}
    {{-- ========================================================================= --}}
    <div class="section-title">PERSONAS INVOLUCRADAS Y TESTIGOS</div>
    @forelse ($denuncia->involucrados as $involucrado)
        <div class="details-box">
            <p><strong>Nombre:</strong> {{ $involucrado->nombre_denunciado ?? 'Desconocido' }}
                @if ($involucrado->es_servidor_publico)
                    <span class="badge">Servidor Público</span>
                @endif
            </p>
            <p class="data-row"><strong>Puesto:</strong> {{ $involucrado->puesto_denunciado ?? 'N/A' }}</p>
            <p class="data-row"><strong>Descripción Física:</strong>
                {{ $involucrado->descripcion_fisica ?? 'Sin descripción.' }}</p>
        </div>
    @empty
        <p>No se proporcionó información detallada sobre personas involucradas o denunciadas.</p>
    @endforelse

    <h4>Testigos</h4>
    @forelse ($denuncia->testigos as $testigo)
        <div class="details-box" style="background-color: #f9f9f9;">
            <p class="data-row"><strong>Nombre:</strong> {{ $testigo->nombre_testigo ?? 'N/A' }}</p>
            <p class="data-row"><strong>Contacto:</strong> {{ $testigo->datos_contacto ?? 'N/A' }}</p>
            <p><strong>Observaciones:</strong> {{ $testigo->observaciones ?? 'Sin observaciones.' }}</p>
        </div>
    @empty
        <p>No se proporcionó información sobre testigos.</p>
    @endforelse

    {{-- ========================================================================= --}}
    {{-- 3. DATOS DEL DENUNCIANTE --}}
    {{-- ========================================================================= --}}
    <div class="section-title">DATOS DEL DENUNCIANTE</div>
    @if ($denuncia->es_anonima)
        <div class="details-box" style="background-color: #fdd;">
            <p style="text-align: center; font-weight: bold;">DENUNCIA ANÓNIMA. No hay datos de contacto registrados.
            </p>
        </div>
    @elseif ($denuncia->contacto)
        <div class="details-box">
            <p class="data-row"><strong>Nombre:</strong> {{ $denuncia->contacto->nombre_completo }}</p>
            <p class="data-row"><strong>Teléfono:</strong> {{ $denuncia->contacto->telefono }}</p>
            <p class="data-row"><strong>Correo:</strong> {{ $denuncia->contacto->correo_electronico }}</p>
        </div>
    @endif

    {{-- NOTA DE PIE DE PÁGINA (OPCIONAL) --}}
    <div style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px; font-size: 8pt; text-align: right;">
        Generado por el Sistema de Denuncias SECOEM el {{ now()->format('d/m/Y H:i:s') }}.
    </div>

</body>

</html>
