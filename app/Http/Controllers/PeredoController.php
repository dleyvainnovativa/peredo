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
    public static function searchByCredito($identificador, $empresa)
    {
        $token = self::getToken();
        $url = env("PEREDO_URL") . "?accion=getDatosRegularizacion";

        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post("$url", [
            'idEmpresa' => $empresa,
            'idCredito' => $identificador,
        ]);

        if (!$response->successful()) {
            return null;
        }

        $json = $response->json();

        if ($json['data'] === "null" || empty($json['data'])) {
            return null;
        }

        $data = $json['data'][0];
        return $data;
        // return (object) [
        //     'name'  => $promotor['NOMBRE_PROMOTOR'] ?? null,
        //     'email' => $promotor['CORREO_PROMOTOR'] ?? null,
        //     'phone' => $promotor['CELULAR_PROMOTOR'] ?? null,
        // ];
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
    public static function setDatosRegularizacion($obj)
    {
        $token = self::getToken();
        $url = env("PEREDO_URL") . "?accion=setDatosRegularizacion";

        if (!$token) {
            return null;
        }
        Log::debug([$obj, "Payload SetDatosRegularizacion"]);

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->asForm()->post("$url", [
            'idEmpresa' => $obj["id_empresa"],
            'idCredito' => $obj["id_credito"],
            'id_documento' => $obj["id_documento"],
            'id_promotor' => $obj["id_promotor"],
        ]);

        if (!$response->successful()) {
            return null;
        }

        $json = $response->json();

        Log::debug([$json, "RESPONSE SetDatosRegularizacion"]);


        if ($json['data'] === "null" || empty($json['data'])) {
            throw new Exception($json["message"] ?? "Error al procesar solicitud");
        }

        $solicitud = $json['data'][0];
        Log::debug([$solicitud, "RESPONSE Solicitud SetDatosRegularizacion"]);

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

    public static function getTemplateValues($credito_data, $content)
    {
        $template_credito = [];
        foreach ($content as $key => $template) {
            if ($template["id"] == "27b06828-3a61-40ab-b0dc-f3f4b638e329") {
                $template_credito = $template;
            }
        }
        $template_fields_all = $template_credito["Fields"];
        $template_fields = [];
        foreach ($template_fields_all as $key => $field) {
            if (isset($field["description"])) {
                $objField["variable"] = $field["variable"];
                $objField["description"] = $field["description"];
                $objField["dataType"] = $field["dataType"];
                array_push($template_fields, $objField);
            }
        }

        $field_mapping = [
            "deu_______________________________________dor" => "CLIENTE",
            "dom________________________________________lio" => "DIRECCION",
            "f__li" => "FOLIO_VENTA",
            "cntdd" => "SALDO_NUM",
            "cntdd__________________ltr" => "SALDO_TEXT",
            "cfntdd" => "MONTOFINANCIADO_NUM",
            "cfntdd__________________ltr" => "MONTOFINANCIADO_TEXT",
            "a_m" => "PLAZO",
            "am___qc" => "DESCUENTO_NUM",
            "amqc____________________________________________ltr" => "DESCUENTO_TEXT",
            "paq" => "TASA_FIJA_UNO",
            "pri____pi" => "PAGOINTENCION_NUM",
            "pripi________________ltr" => "PAGOINTENCION_TEXT",
            "priam___qc" => "PAGOINTENCION_NUM2",
            "priamqc____________________________________________ltr" => "PAGOINTENCION_TEXT2",
            "a_mq" => "PLAZO_QUINCENAL",
            "no_____________________________________________________qu" => "QUINCENA_INICIAL",
            "no2_____________________________________________qu" => "QUINCENA_FINAL",
            "paq2" => "TASA_FIJA_DOS",
            "cts________________________rfa" => "CUENTAS",
            "cd______________________________________pg" => "CIUDAD_CREDITO",
        ];

        $template_values = collect($template_fields)->map(function ($field) use ($field_mapping, $credito_data) {
            $credit_key = $field_mapping[$field['variable']] ?? null;
            $field_value = $credit_key ? ($credito_data[$credit_key] ?? '') : '';
            if ($field["dataType"] == "date") {
                $field_value = date("d-m-Y");
            }
            return [
                "name" => $field['variable'],
                "description" => $field['description'],
                "type" => $field['dataType'],
                "credit_field" => $credit_key,
                "value" => $field_value
            ];
        })->values()->toArray();
        return $template_values;
    }
}
