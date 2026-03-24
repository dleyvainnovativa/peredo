<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class PeredoController extends Controller
{
    /**
     * Get auth token
     */
    private static function getToken()
    {
        return Cache::remember('custom_token', 600, function () {
            $url = env("PEREDO_URL") . "?accion=getAutentificacion";


            $response = Http::asForm()->post("$url", [
                'usuario'   => 'ContiSign.system',
                'client_id' => 'ContiSign',
            ]);

            if (!$response->successful()) {
                return null;
            }

            $json = $response->json();

            // ✅ token comes in "data"
            return $json['data'] ?? null;
        });
    }

    /**
     * Search using token
     */
    public static function searchByIdentificador($identificador)
    {
        $token = self::getToken();
        $url = env("PEREDO_URL") . "?accion=getDatosPromotor";

        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post("$url", [
            'identificador' => $identificador
        ]);

        if (!$response->successful()) {
            return null;
        }

        $json = $response->json();

        if ($json['data'] === "null" || empty($json['data'])) {
            return null;
        }

        $promotor = $json['data'][0];

        return (object) [
            'name'  => $promotor['NOMBRE_PROMOTOR'] ?? null,
            'email' => $promotor['CORREO_PROMOTOR'] ?? null,
            'phone' => $promotor['CELULAR_PROMOTOR'] ?? null,
        ];
    }
    public static function setDatosSolicitud($obj)
    {
        $token = self::getToken();
        $url = env("PEREDO_URL") . "?accion=setDatosSolicitud";

        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post("$url", [
            'nombre' => $obj,
            'apellido_paterno' => $obj,
            'apellido_materno' => $obj,
            'rfc' => $obj,
            'email' => $obj,
            'celular' => $obj,
            'id_empresa' => $obj,
            'id_documento' => $obj,
            'numero_empleado' => $obj,
            'monto_prestamo' => $obj,
            'id_documento ' => $obj,
            'id_documento ' => $obj,
        ]);

        if (!$response->successful()) {
            return null;
        }

        $json = $response->json();

        if ($json['data'] === "null" || empty($json['data'])) {
            return null;
        }

        $promotor = $json['data'][0];

        return (object) [
            'name'  => $promotor['NOMBRE_PROMOTOR'] ?? null,
            'email' => $promotor['CORREO_PROMOTOR'] ?? null,
            'phone' => $promotor['CELULAR_PROMOTOR'] ?? null,
        ];
    }
}
