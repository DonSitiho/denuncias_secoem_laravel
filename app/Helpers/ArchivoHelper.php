<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ArchivoHelper
{
    /**
     * Encripta y guarda un archivo dependiendo de su tipo MIME.
     *
     * @param \Illuminate\Http\UploadedFile $archivo
     * @param string $directorio
     * @return array|null  // Retorna información del archivo o null si falla
     */
    public static function guardarArchivoEncriptado($archivo, $directorio = 'archivos_denuncias')
    {
        try {
            $mime = $archivo->getClientMimeType();
            $extension = $archivo->getClientOriginalExtension();
            $contenido = file_get_contents($archivo->getRealPath());

            // Crear carpeta si no existe
            $disk = Storage::disk('local');
            if (!$disk->exists($directorio)) {
                $disk->makeDirectory($directorio, 0755, true);
            }

            // Clasificar tipo
            switch (true) {
                case str_starts_with($mime, 'image/'):
                    $contenidoEncriptado = Crypt::encrypt($contenido);
                    $categoria = 'imagen';
                    break;

                case str_starts_with($mime, 'video/'):
                    $contenidoEncriptado = Crypt::encrypt($contenido);
                    $categoria = 'video';
                    break;

                case str_starts_with($mime, 'application/pdf'):
                    $contenidoEncriptado = Crypt::encrypt($contenido);
                    $categoria = 'documento';
                    break;

                default:
                    $contenidoEncriptado = Crypt::encrypt($contenido);
                    $categoria = 'otro';
                    break;
            }

            //  Nombre y ruta final
            $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();
            $ruta = $directorio . '/' . $nombreArchivo;

            //  Guardar archivo cifrado
            $disk->put($ruta, $contenidoEncriptado);

            return [
                'nombre' => $archivo->getClientOriginalName(),
                'mime' => $mime,
                'ruta' => $ruta,
                'categoria' => $categoria,
                'extension' => $extension,
            ];

        } catch (\Exception $e) {
            \Log::error('Error al guardar archivo encriptado: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Desencripta y devuelve el archivo guardado para descarga o visualización.
     *
     * @param string $ruta Ruta completa dentro del disco local.
     * @param string $nombreArchivo Nombre original del archivo (para encabezado).
     * @param string $tipoMime Tipo MIME del archivo (para el header HTTP).
     * @param bool $descargar Si es true, fuerza descarga; si es false, lo muestra en el navegador.
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\StreamedResponse|null
     */
    public static function descargarArchivoEncriptado($ruta, $nombreArchivo, $tipoMime, $descargar = true)
    {
        try {
            //  Obtener el contenido cifrado del archivo
            if (!Storage::disk('local')->exists($ruta)) {
                return response()->json(['error' => 'Archivo no encontrado.'], 404);
            }

            $contenidoEncriptado = Storage::disk('local')->get($ruta);

            //  Desencriptar el contenido
            $contenido = \Illuminate\Support\Facades\Crypt::decrypt($contenidoEncriptado);

            //  Enviar respuesta HTTP
            $disposicion = $descargar ? 'attachment' : 'inline';

            return response($contenido)
                ->header('Content-Type', $tipoMime)
                ->header('Content-Disposition', $disposicion . '; filename="' . $nombreArchivo . '"');

        } catch (\Exception $e) {
            \Log::error('Error al desencriptar archivo: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo desencriptar el archivo.'], 500);
        }
    }
}
