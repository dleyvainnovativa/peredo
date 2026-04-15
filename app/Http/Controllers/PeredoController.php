<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


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
    public static function getDatosDocumentos($identificador)
    {
        $token = self::getToken();
        $url = env("PEREDO_URL") . "?accion=getDatosDocumentos&identificador=$identificador";

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

        return $json['data'];
    }
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
        Log::debug([$obj, "Payload SetDatosSolicitud"]);

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post("$url", [
            'nombre' => $obj["nombre"],
            'apellido_paterno' => $obj["apellido_paterno"],
            'apellido_materno' => $obj["apellido_materno"],
            'rfc' => $obj["rfc"],
            'email' => $obj["email"],
            'celular' => $obj["celular"],
            'id_empresa' => $obj["id_empresa"],
            'id_documento' => $obj["id_documento"],
            'numero_empleado' => $obj["numero_empleado"],
            'monto_prestamo' => $obj["monto_prestamo"],
            'uuid_ultimo_pago' => $obj["uuid_ultimo_pago"],
            'id_promotor' => $obj["id_promotor"],
        ]);

        if (!$response->successful()) {
            return null;
        }

        $json = $response->json();

        Log::debug([$json, "RESPONSE SetDatosSolicitud"]);


        if ($json['data'] === "null" || empty($json['data'])) {
            throw new Exception($json["message"] ?? "Error al procesar solicitud");
        }

        $solicitud = $json['data'][0];
        Log::debug([$solicitud, "RESPONSE Solicitud SetDatosSolicitud"]);

        return (object) [
            'id'  => $solicitud['IDENTIFICADOR'] ?? null,
            'folio' => $solicitud['FOLIO_SOLICITUD'] ?? null,
        ];
    }
    public static function updateDatosSolicitud($obj)
    {
        $token = self::getToken();
        $url = env("PEREDO_URL") . "?accion=setSeguimientoSolicitud";
        if (!$token) {
            return null;
        }

        Log::debug([$obj, "Payload setSeguimientoSolicitud"]);

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post("$url", $obj);

        if (!$response->successful()) {
            return null;
        }
        Log::debug([$response->body(), "RESPONSE RAW setSeguimientoSolicitud"]);

        $json = $response->json();

        Log::debug([$json, "RESPONSE setSeguimientoSolicitud"]);

        return;
    }
}
