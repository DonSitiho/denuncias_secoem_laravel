<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Recaptcha implements ValidationRule
{
    protected ?string $expectedAction;
    protected float $minScore;

    public function __construct(?string $expectedAction = null, ?float $minScore = null)
    {
        $this->expectedAction = $expectedAction;
        $this->minScore = $minScore ?? config('services.recaptcha.min_score', 0.5);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('El token de reCAPTCHA es requerido.');
            return;
        }

        try {
            $response = Http::asForm()
                ->timeout(5)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.recaptcha.secret_key'),
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]);
        } catch (\Throwable $e) {
            //Log::error('Error al conectar con reCAPTCHA API', ['error' => $e->getMessage()]);
            $fail('No se pudo verificar la seguridad del formulario. Intenta nuevamente.');
            return;
        }

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            $fail('La verificación de seguridad no pudo completarse. Intenta nuevamente.');
            return;
        }

        if (($result['score'] ?? 0) < $this->minScore) {
            $fail('La verificación de seguridad falló. Intenta nuevamente.');
            return;
        }

        if ($this->expectedAction !== null && ($result['action'] ?? '') !== $this->expectedAction) {
            $fail('La verificación de seguridad no es válida para esta acción.');
            return;
        }
    }
}
