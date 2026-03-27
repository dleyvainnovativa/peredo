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
    public static function updateDatosSolicitud($obj, $movimiento)
    {
        $token = self::getToken();
        $url = env("PEREDO_URL") . "?accion=setSeguimientoSolicitud";
        if (!$token) {
            return null;
        }

        $new_value = null;
        switch ($movimiento) {
            // case 1:
            //     $new_value = $obj["document_url"];
            //     break;
            case 5:
                $new_value = date('Y-m-d');
                break;
            case 6:
                $new_value = $obj["document_url"];
                break;
            case 8:
                $new_value = $obj["id_contisign"];
                break;
            case 9:
                $new_value = $obj["status"];
                break;

            default:
                # code...
                break;
        }

        Log::debug([[
            'id_solicitud ' => $obj["peredo_id"],
            'id_movimiento' => $movimiento,
            'dato_nuevo' => $new_value,
        ], "Payload setSeguimientoSolicitud"]);

        if ($new_value != null) {

            $response = Http::withHeaders([
                'Authorization' => $token
            ])->asForm()->post("$url", [
                'id_solicitud ' => $obj["peredo_id"],
                'id_movimiento' => $movimiento,
                'dato_nuevo' => $new_value,
            ]);

            if (!$response->successful()) {
                return null;
            }

            $json = $response->json();

            Log::debug([$json, "RESPONSE setSeguimientoSolicitud"]);
        }

        // if ($json['error'] != 0) {
        //     throw new Exception($json["message"] ?? "Error al procesar solicitud");
        // }
        return;
    }
}
