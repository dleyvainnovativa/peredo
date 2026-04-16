<?php

namespace App\Http\Controllers;

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
        // $date = new DateTime('now', new DateTimeZone('America/Mexico_City'));
        // $passClave = '19p3r3d096c0nsorc1o2109';
        // $password = '19p3r3d096c0nsorc1o2109';
        // // $password = '19p3r3d096c0nsorc1o2109' . $date->format('Ymd');

        // $promotorHsh = self::encryptWithPassword(22, $password);
        // $empresaHsh = self::encryptWithPassword(3, $password);
        // $promotor = self::decryptWithPassword($request->input("promotor"), $password) ?? null;
        // $empresa = self::decryptWithPassword($request->input("empresa"), $password) ?? null;

        // dd($promotorHsh, $empresaHsh, $request->input("promotor"), $request->input("empresa"), $promotor, $empresa);

        // r3B5wTMgGROnAoGCPk3TBonKU4YNyJJLF/Zh1zuewdA=
        // WjutvRrlVUZCve/iNWk1c7G9zzVQ8uvoLXv6fG6yf9A=
        // dd($password, $request->input("promotor"), $request->input("empresa"), $promotor, $empresa, $date->format('Ymd'));

        $logo = asset('img/logo.png');
        $empresa_flag = false;
        // dd($promotor, $empresa, $request);
        $templates = [];
        $content = getJsonData("templates/templates.json");
        $companies = getJsonData("company/companies.json");


        // dd($documentsRaw, $documentsRaw2);

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
        // $documentsRaw2 = getJsonData("company/documents.json");
        $documents = [];
        $formatArray = [
            'FORMATO_1' => 'REFACIL_ETESA',
            'FORMATO_2' => 'REFACIL_NOMI-PAY',
            'FORMATO_3' => 'REFACIL_SEP Puebla',
            'FORMATO_4' => 'REFACIL_ETESA_NOMIPAY',
            'FORMATO_5' => 'REFACIL_BENEFIT',
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
        // dd($templates);
        $data["templates"] = $templates;
        $data["empresa"] = $empresa;
        $data["promotor"] = $promotor;
        $data["documents"] = $documents;
        return view('pages.request', $data);
    }
    private static function getTemplateID($name)
    {
        $name_id = strtolower($name);
        $name_id = str_replace(' solicitud', '', $name_id);
        $name_id = preg_replace('/[^a-z0-9_]/', '', $name_id);
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
}
