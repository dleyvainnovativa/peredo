<?php

namespace App\Http\Controllers;

use App\Services\ContisignService;
use DateTime;
use DateTimeZone;
use Exception;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function search(Request $request)
    {
        try {
            $validated = $request->validate([
                'employee' => 'required|string|max:255',
            ]);

            $employee_num = $validated["employee"];
            $employee = PeredoController::searchByIdentificador($employee_num);
            $data = $employee;
            if ($employee) {
                return SuccessResponse(200, "Fecha actualizada", __METHOD__, $data);
            } else {
                return SuccessResponse(400, "No hay promotor registrado", __METHOD__, $employee);
            }
            // $employee_num = $validated["employee"];

            // $employees = getJsonData("employees.json");
            // $employee = [];
            // foreach ($employees as $key => $value) {
            //     if ($value["employee"] == $validated["employee"]) {
            //         $employee = $value;
            //     }
            // }
            // // dd($employees, $employee, $employee_num);
            // if (empty($employee)) {
            //     return ErrorResponse(400, "Empleado no encontrado", __METHOD__, $request);
            // }

        } catch (Exception $e) {
            return ErrorResponse(400, $e->getMessage(), __METHOD__, $request);
        }
    }
    public function index(Request $request)
    {
        $promotor = ($request->input("promotor")) ?? null;
        $empresa = ($request->input("empresa")) ?? null;
        $logo = asset('img/logo.png');
        $empresa_flag = false;
        $templates = [];
        $content = getJsonData("templates/templates.json");
        $companies = getJsonData("company/companies.json");
        foreach ($companies as $key => $company) {
            if ($company["IDENTIFICADOR"] == $empresa) {
                $logo = asset("img/$empresa.png");
                $empresa_flag = true;
            }
        }
        $data["logo"] = $logo;
        if (!$promotor) {
            $data["title"] = "¡No hay promotor asignado!";
            $data["subtitle"] = "Falta agregar el promotor en la petición.
                                    Verifica la información proporcionada o contacta al administrador para más detalles.";
            return view('error', $data);
        } else {
            $employee = PeredoController::searchByIdentificador($promotor);
            if (!$employee) {
                $data["title"] = "¡Promotor no identificado!";
                $data["subtitle"] = "El promotor que estás intentando consultar no se encuentra registrado en nuestro sistema.
                                    Verifica la información proporcionada o contacta al administrador para más detalles.";
                return view('error', $data);
            }
        }
        if ($empresa_flag == false) {
            $data["title"] = "¡Empresa no encontrada!";
            $data["subtitle"] = "La empresa que estás intentando consultar no se encuentra registrada en nuestro sistema.
                                    Verifica la información proporcionada o contacta al administrador para más detalles.";
            return view('error', $data);
        }

        $documentsRaw = PeredoController::getDatosDocumentos($promotor);
        $documents = [];
        $formatArray = [
            'FORMATO_1' => 'REFACIL_ETESA',
            'FORMATO_2' => 'REFACIL_NOMI-PAY',
            'FORMATO_3' => 'REFACIL_SEP_Puebla',
            'FORMATO_4' => 'REFACIL_ETESA_NOMIPAY',
            'FORMATO_5' => 'REFACIL_BENEFIT',
            'FORMATO_6' => 'REFACIL_ETESA_TABASCO',
        ];
        foreach ($documentsRaw as &$doc) {
            $formato = $doc['DOCUMENTO'] ?? null;
            $doc['FORMATO'] = $formatArray[$formato] ?? null;
        }
        unset($doc);

        foreach ($documentsRaw as $doc) {
            $sucursal = $doc['SUCURSAL'];
            $dependencia = $doc['DEPENDENCIA'];
            if (!isset($documents[$sucursal])) {
                $documents[$sucursal] = [];
            }
            if (!isset($documents[$sucursal][$dependencia])) {
                $documents[$sucursal][$dependencia] = [];
            }
            $documents[$sucursal][$dependencia][] = [
                "doc_id" => self::getTemplateID($doc['FORMATO']),
                "documento" => $doc['DOCUMENTO'],
                "documento_id" => $doc['ID_DOCUMENTO'],
                "formato" => $doc['FORMATO'],
                "campos" => explode(",", $doc['CAMPOS'])
            ];
        }
        foreach ($content as $key => $template) {
            $name = $template["TemplateName"];
            $image = $template["image"] ?? "";
            $templateObj["doc_id"] = self::getTemplateID($name);
            $templateObj["name"] = $name;
            $templateObj["filename"] = "";
            $templateObj["image"] = $image;
            $templateObj["content"] = json_encode($template);
            $templates[] = $templateObj;
        }
        // dd($templates, $documents);
        $data["templates"] = $templates;
        $data["empresa"] = $empresa;
        $data["promotor"] = $promotor;
        $data["documents"] = $documents;
        $data["employee"] = $employee;
        $missingFields = [];

        if (empty($employee->name)) {
            $missingFields[] = 'Nombre';
        }

        if (empty($employee->email)) {
            $missingFields[] = 'Correo';
        }

        if (empty($employee->phone)) {
            $missingFields[] = 'Teléfono';
        }
        $data["missingFields"] = $missingFields;
        return view('pages.request', $data);
    }
    public function regularizacion(Request $request)
    {
        $credito = ($request->input("credito")) ?? null;
        $empresa = ($request->input("empresa")) ?? null;
        $logo = asset('img/logo.png');
        $empresa_flag = false;
        $templates = [];
        $content = getJsonData("templates/templates.json");
        $companies = getJsonData("company/companies.json");
        $credito_data = [];
        foreach ($companies as $key => $company) {
            if ($company["IDENTIFICADOR"] == $empresa) {
                $logo = asset("img/$empresa.png");
                $empresa_flag = true;
            }
        }
        // dd($request);
        $data["logo"] = $logo;
        if (!$credito) {
            $data["title"] = "¡No hay identificador del crédito a consultar asignado!";
            $data["subtitle"] = "Falta agregar el identificador del crédito a consultar en la petición.
                                    Verifica la información proporcionada o contacta al administrador para más detalles.";
            return view('error', $data);
        } else {
            $credito_data = PeredoController::searchByCredito($credito, $empresa);
            if (!$credito_data) {
                $data["title"] = "Identificador del crédito a consultar no identificado!";
                $data["subtitle"] = "El ID que estás intentando consultar no se encuentra registrado en nuestro sistema.
                                    Verifica la información proporcionada o contacta al administrador para más detalles.";
                return view('error', $data);
            }
        }
        if ($empresa_flag == false) {
            $data["title"] = "¡Empresa no encontrada!";
            $data["subtitle"] = "La empresa que estás intentando consultar no se encuentra registrada en nuestro sistema.
                                    Verifica la información proporcionada o contacta al administrador para más detalles.";
            return view('error', $data);
        }

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
                array_push($template_fields, $field);
            }
        }

        $field_mapping = [
            "deu_______________________________________dor" => "CLIENTE",
            "dom________________________________________lio" => "DIRECCION",
            "f__li" => "FOLIO_VENTA",
            "cntdd" => "SALDO_NUM",
            "cntdd__________________ltr" => "SALDO_TEXT",
            "a_m" => "PLAZO_QUINCENAL",
            "am___qc" => "DESCUENTO_NUM",
            "amqc____________________________________________ltr" => "DESCUENTO_TEXT",
            "paq" => "TASA_FIJA_DOS",
            "ad___ac" => "SALDO_NUM",
            "adac___________________________________ltr" => "SALDO_TEXT",
            "pri____pi" => "PAGOINTENCION_NUM",
            "pripi________________ltr" => "PAGOINTENCION_TEXT",
            "cts________________________rfa" => "CUENTAS",
            "cd______________________________________pg" => "CIUDAD", // if you have it
        ];

        $template_values = collect($template_fields)->map(function ($field) use ($field_mapping, $credito_data) {
            $credit_key = $field_mapping[$field['variable']] ?? null;
            return [
                "name" => $field['variable'],
                "description" => $field['description'],
                "type" => $field['dataType'],
                "value" => $credit_key ? ($credito_data[$credit_key] ?? '') : ''
            ];
        })->values()->toArray();

        // $data["template_fields"] = $template_fields;
        // $data["template"] = $template_credito;
        // $data["empresa"] = $empresa;
        $data["credito"] = $credito_data;
        $data["template_values"] = $template_values;
        dd($data);

        // $documentsRaw = PeredoController::getDatosDocumentos($promotor);
        // $documents = [];
        // $formatArray = [
        //     'FORMATO_1' => 'REFACIL_ETESA',
        //     'FORMATO_2' => 'REFACIL_NOMI-PAY',
        //     'FORMATO_3' => 'REFACIL_SEP_Puebla',
        //     'FORMATO_4' => 'REFACIL_ETESA_NOMIPAY',
        //     'FORMATO_5' => 'REFACIL_BENEFIT',
        //     'FORMATO_6' => 'REFACIL_ETESA_TABASCO',
        // ];
        // foreach ($documentsRaw as &$doc) {
        //     $formato = $doc['DOCUMENTO'] ?? null;
        //     $doc['FORMATO'] = $formatArray[$formato] ?? null;
        // }
        // unset($doc);

        // foreach ($documentsRaw as $doc) {
        //     $sucursal = $doc['SUCURSAL'];
        //     $dependencia = $doc['DEPENDENCIA'];
        //     if (!isset($documents[$sucursal])) {
        //         $documents[$sucursal] = [];
        //     }
        //     if (!isset($documents[$sucursal][$dependencia])) {
        //         $documents[$sucursal][$dependencia] = [];
        //     }
        //     $documents[$sucursal][$dependencia][] = [
        //         "doc_id" => self::getTemplateID($doc['FORMATO']),
        //         "documento" => $doc['DOCUMENTO'],
        //         "documento_id" => $doc['ID_DOCUMENTO'],
        //         "formato" => $doc['FORMATO'],
        //         "campos" => explode(",", $doc['CAMPOS'])
        //     ];
        // }
        // foreach ($content as $key => $template) {
        //     $name = $template["TemplateName"];
        //     $image = $template["image"] ?? "";
        //     $templateObj["doc_id"] = self::getTemplateID($name);
        //     $templateObj["name"] = $name;
        //     $templateObj["filename"] = "";
        //     $templateObj["image"] = $image;
        //     $templateObj["content"] = json_encode($template);
        //     $templates[] = $templateObj;
        // }
        // // dd($templates, $documents);
        // $data["templates"] = $templates;
        // $data["empresa"] = $empresa;
        // $data["promotor"] = $promotor;
        // $data["documents"] = $documents;
        // $data["employee"] = $employee;
        // $missingFields = [];

        // if (empty($employee->name)) {
        //     $missingFields[] = 'Nombre';
        // }

        // if (empty($employee->email)) {
        //     $missingFields[] = 'Correo';
        // }

        // if (empty($employee->phone)) {
        //     $missingFields[] = 'Teléfono';
        // }
        // $data["missingFields"] = $missingFields;
        return view('pages.regularizacion', $data);
    }

    private static function getTemplateID($name)
    {
        $name_id = strtolower($name);
        $name_id = str_replace(' solicitud', '', $name_id);
        $name_id = str_replace('-', '', $name_id);
        $name_id = preg_replace('/\s+/', '_', $name_id);
        $name_id = preg_replace('/[^a-z0-9_]/', '', $name_id);
        $name_id = preg_replace('/_+/', '_', $name_id);
        $name_id = trim($name_id, '_');
        return $name_id;
    }

    private function decryptWithPassword($encryptedData, $password)
    {
        $encryptedData = strtr($encryptedData, '-_', '+/');

        $remainder = strlen($encryptedData) % 4;
        if ($remainder) {
            $encryptedData .= str_repeat('=', 4 - $remainder);
        }

        $data = base64_decode($encryptedData);

        $iv = substr($data, 0, 16);
        $ciphertext = substr($data, 16);

        return openssl_decrypt(
            $ciphertext,
            'AES-256-CBC',
            $key = hash('sha256', $password, true),
            OPENSSL_RAW_DATA,
            $iv
        );
    }
    private static function encryptWithPassword($data, $password)
    {
        $key = hash('sha256', $password, true);
        $iv = random_bytes(16);

        $encrypted = openssl_encrypt(
            $data,
            'AES-256-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );

        return rtrim(strtr(base64_encode($iv . $encrypted), '+/', '-_'), '=');
    }
    private static function encryptWithPassword2($data, $password)
    {
        $key = hash('sha256', $password, true);
        $iv = random_bytes(16);

        $encrypted = openssl_encrypt(
            $data,
            'AES-256-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        return base64_encode($iv . $encrypted);
    }
    public function showPdf($id)
    {
        $data = app(ContisignService::class)->getFullDocument($id);
        if (!isset($data['documentUrl'])) {
            abort(404, 'PDF not available');
        }
        $base64 = $data['documentUrl'];
        // Remove data URI prefix
        $base64 = preg_replace(
            '/^data:application\/pdf;base64,/',
            '',
            $base64
        );
        $pdfContent = base64_decode($base64);
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="document.pdf"');
    }
    public function showXml($id)
    {
        $data = app(ContisignService::class)->getFullDocument($id);

        if (!isset($data['constance']['base64'])) {
            abort(404, 'XML not available');
        }
        $base64 = $data['constance']['base64'];
        $xmlContent = base64_decode($base64);

        if ($xmlContent === false) {
            abort(500, 'Invalid XML content');
        }

        return response($xmlContent, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'inline; filename="constancia.xml"');
    }
    public function showAnnexed($id, $type)
    {
        try {
            $data = app(ContisignService::class)->getFullDocument($id);
            // $path = storage_path('app/public/document.json');
            // $data = json_decode(file_get_contents($path), true);
            // if (!isset($data['annexed'])) {
            //     abort(404, 'Annexed documents not available');
            // }
            switch ($type) {

                case 'ine':
                    $searchKeyword = 'ine';
                    break;

                case 'selfie':
                    $searchKeyword = 'selfie';
                    break;

                default:
                    abort(404, 'Invalid annexed type');
            }
            $document = collect($data['annexed'])
                ->first(function ($item) use ($searchKeyword) {

                    return str_contains(
                        strtolower($item['FileName']),
                        strtolower($searchKeyword)
                    );
                });
            if (!$document) {
                abort(404, 'Document not found');
            }
            if (!isset($document["path"])) {
                abort(404, 'Document path not available');
            }
            $base64 = $document['path'];
            $base64 = explode(',', $document['path'], 2)[1] ?? '';
            // Remove spaces/newlines
            $base64 = str_replace(
                ["\r", "\n", " "],
                '',
                $base64
            );
            $fileContent = base64_decode($base64);

            return response($fileContent, 200)
                ->header('Content-Type', $document['mimetype'])
                ->header(
                    'Content-Disposition',
                    'inline; filename="' . $document['originalName'] . '"'
                );
        } catch (\Throwable $e) {


            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
