<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class TemplateController extends Controller
{

    // gixtepan@sistemascontino.com.mx
    // achavez@sistemascontino.com.mx
    public static function template($contisign, $requestSignatures, $template, $fields, $html, $request, $annexed, $annexedSelfie, $register, $peredo)
    {
        try {
            //code...

            $dataTemplatesFields = [];
            $annexedFile = self::setAnnexed($annexed, 'INE');
            $annexedSelfieFile = self::setAnnexed($annexedSelfie, 'Selfie');



            foreach ($fields as $field) {
                $dataTemplatesFields[$field["name"]] = $field["value"];
            }

            $moreTags = self::buildMoreTags($request);

            // $limit_date = date('Y-m-d', strtotime('+1 month'));
            $limit_date = date('Y-m-d', strtotime('+3 days'));

            // // === 1. Create UniKey ===
            // // Use the ID from the JSON template
            $uniKeyPayload = [
                "UniKey" => self::generateUniKey($template["TemplateName"]), // This might also be dynamic
                "thisTemplateId" => $template['id'],
                "user_id" => env('CONTISIGN_ID'), // This should be the current user's ID
                "version" => false
            ];
            Log::debug(["UniKey Payload:", $uniKeyPayload]);
            $uniKeyData = $contisign->createUniKey($uniKeyPayload);
            Log::debug(["UniKey Data:", $uniKeyData]);
            // $uniKeyData["contractId"] = "test";
            // $uniKeyData["personId"] = "test";
            // $uniKeyData["unikey"] = "test";

            // === 2. Build Signatures from UserSigns in the template ===
            $signatures = [];
            foreach ($template['UserSigns'] as $userSign) {
                foreach ($requestSignatures as $key => $rSign) {
                    if (strtolower($rSign["type"]) == strtolower($userSign["Name"])) {
                        $userEmail = $rSign["email"];
                        $userName = $rSign["name"];
                    }
                }
                if ($userSign["Charge"] == "Signed") {
                    $signature = [
                        "Name" => $userName,
                        "Email" => $userEmail,
                        "Charge" => $userSign['Charge'],
                        "Position" => $userSign['Position'],
                        "BusinessName" => $userSign['BusinessName'],
                        "Order" => $userSign['Order'],
                        "external" => true,
                        "bgColor" => $userSign['bgColor'] ?? '9b039999',
                        "x" => $userSign['x'] ?? null,
                        "y" => $userSign['y'] ?? null,
                        "width" => $userSign['width'] ?? null,
                        "height" => $userSign['height'] ?? null,
                        "dimension" => $userSign['dimension'] ?? ['w' => 599, 'h' => 846],
                        "Status" => "Esperando",
                        "currentUserExternal" => $userSign['external'],
                        "LimitDate" => $limit_date,
                        // Assuming SignType has at least one value
                        // "Type" => $template['SignType'][0] ?? "Firma sencilla"
                    ];

                    // Add AditionalInformation for compatibility
                    $signature["AditionalInformation"] = [
                        "x" => $signature['x'],
                        "y" => $signature['y'],
                        "width" => $signature['width'],
                        "height" => $signature['height'],
                        "bgcolor" => "#" . $signature['bgColor'],
                        "name" => $signature['Name'],
                        "dimensions" => $signature['dimension']
                    ];
                } else {
                    $signature = [
                        "Name" => $userName,
                        "Email" => $userEmail,
                        "Charge" => $userSign['Charge'],
                        "Position" => $userSign['Position'],
                        "BusinessName" => $userSign['BusinessName'],
                        "Order" => null,
                        "external" => false,
                        "Status" => "Esperando",
                        "currentUserExternal" => $userSign['external'],
                        "Type" => $template['SignType'][0] ?? "Firma sencilla",
                        "LimitDate" => $limit_date
                    ];

                    // Add AditionalInformation for compatibility
                    $signature["AditionalInformation"] = [
                        "bgcolor" => "#undefined",
                        "name" => $signature['Name']
                    ];
                }

                if ($userSign["Charge"] == "Signed") {
                    foreach ($template["SignType"] as $key => $value) {
                        $signature["Type"] = $value;
                        $signatures[] = $signature;
                    }
                } else {
                    $signatures[] = $signature;
                }
            }
            Log::debug(["Signatures:", $signatures]);

            // dd($requestSignatures, $signatures, $fields, $uniKeyPayload);

            // // dd(json_encode($signatures));

            // // === 3. Create DataTemplate ===
            $dataTemplatePayload = [
                "Active" => $template['Active'],
                "annexed" => [$annexedFile, $annexedSelfieFile],
                "Signsstatus" => "Este documento no ha sido firmado",
                "contract_id" => $uniKeyData['contractId'],
                "DataTemplates" => $dataTemplatesFields,
                "DocumentName" => $template['Formato'] . " Solicitud de " . $requestSignatures[0]["name"],
                "dtperson_id" => $uniKeyData['personId'],
                "Tags" => array_merge(
                    ["sistemas", "contino"], // Base tags
                    explode(' ', str_replace('_', ' ', $template['TemplateName'])), // Tags from template name
                    $moreTags
                ),
                "Emptytemplate" => null,
                "user_id" => env('CONTISIGN_ID'),
                "positionRequired" => $template['positionRequired'],
                "UniKey" => $uniKeyData['unikey'],
                "html" => $html,
                "templateId" => $template['id'],
                "documentUrl" => null,
                "ConstancePSC" => $template['PSCreq'],
                "OnlyNOM151" => $template['OnlyNOM151'],
                "Fields" => null, // This is often set to null when DataTemplates is used
                "signatures" => $signatures
            ];
            // dd(json_encode($dataTemplatePayload));
            Log::debug(["Data Template Payload:", $dataTemplatePayload]);
            $dataTemplateData = $contisign->createDataTemplate($dataTemplatePayload);
            Log::debug(["Data Template Data:", $dataTemplateData]);

            // dd($requestSignatures, $signatures, $fields, $uniKeyPayload, $dataTemplatePayload);

            // === 4. Send Signs ===
            // Add the documentid to each signature for the sendSigns payload
            $signsPayloadSignatures = array_map(function ($sig) use ($dataTemplateData) {
                $sig['documentid'] = $dataTemplateData['id'];
                return $sig;
            }, $signatures);

            Log::debug(["Signs Payload Signatures:", $signsPayloadSignatures]);

            $signsPayload = [
                "signs" => $signsPayloadSignatures,
                "firmas" => 999999 // This seems like a static value
            ];


            $signsData = $contisign->sendSigns($signsPayload);
            Log::debug(["Signs Data:", $signsData]);


            // // === 5. Return Response ===
            $data = [
                'unikey' => $uniKeyData['unikey'],
                'documentId' => $dataTemplateData['id'],
                'status' => $dataTemplateData['Signsstatus'],
                'message' => $signsData['Message'] ?? 'Documento generado correctamente'
            ];

            $register["id_contisign"] = $dataTemplateData['id'];
            $register["unikey"] = $uniKeyData['unikey'];
            $register["status"] = $dataTemplateData['Signsstatus'];
            $register["document_url"] = $dataTemplateData['documentUrl'];

            RequestController::store($register);
            $updated = [
                "id_solicitud" => $register["peredo_id"],
                "fecha_genera_doc" => self::formatDate($dataTemplateData["created_at"]),
                "id_contisign" => $dataTemplateData['id'],
                "estatus_contisign" => $dataTemplateData['Signsstatus'],
                "liga_cliente" => null,
                "fecha_firma_cliente" => null,
                "liga_promotor" => null,
                "fecha_firma_promotor" => null,
                "rutaQR_XML" => $dataTemplateData['ConstancyRC'],
                "rutaQR_PDF" => $dataTemplateData["documentUrl"],
                "ruta_INE" => $annexedFile["FieldUrl"],
                "ruta_Selfie" => $annexedSelfieFile["FieldUrl"],
            ];
            PeredoController::updateDatosSolicitud($updated);



            Log::debug(["Final Data:", $data]);


            return response()->json($data);
        } catch (Exception $th) {
            throw new Exception($th->getMessage());
        }
    }


    public static function buildMoreTags($request)
    {
        $tags = [];

        // Attributes you want to skip
        $except = [
            'html',
            '_token',
            'fields',
            'template_id',
            'employee_email',
            'leader_email',
        ];

        foreach ($request->except($except) as $key => $value) {
            if (!is_string($value) || trim($value) === '') continue;

            // Remove accents
            $noAccents = iconv('UTF-8', 'ASCII//TRANSLIT', $value);

            // Convert to lowercase
            $lower = strtolower($noAccents);

            // Split by spaces
            $words = preg_split('/\s+/', $lower);

            // Clean each word (remove punctuation or weird characters)
            foreach ($words as $w) {
                $clean = preg_replace('/[^a-z0-9_]/', '', $w);
                if ($clean !== '') {
                    $tags[] = $clean;
                }
            }
        }

        // Return unique tags
        return array_values(array_unique($tags));
    }

    public static function generateUniKey($templateName)
    {
        $templateName = trim($templateName);
        // Replace "-" with ""
        $templateName = str_replace('-', '', $templateName);
        // Keep only uppercase letters and "_"
        preg_match_all('/[A-Z_]/', $templateName, $matches);
        $letters = implode('', $matches[0]);
        // Concatenate OU
        $unikey = 'OU' . $letters;
        return $unikey;
    }

    public static function formatDate($date)
    {
        $formatted = null;
        if ($date) {
            $formatted = Carbon::parse($date)->format('d/m/Y H:i:s');
        }
        return $formatted;
    }


    public static function setAnnexed($file, $name)
    {
        try {

            if (!$file || !$file->isValid()) {
                return null;
            }
            $filename = Str::uuid() . '.pdf';
            $response = Http::timeout(30)->attach(
                'file',
                fopen($file->getRealPath(), 'r'),
                $filename
            )->post('https://api.contisign.com.mx/api/uploaddocumentfile', [
                'type' => 'annexed'
            ]);

            if (!$response->successful()) {
                throw new \Exception('Error al subir archivo a Contisign');
            }
            $data = $response->json();
            return
                [
                    "FileName" => $name,
                    "FieldUrl" => $data['ImageUrl'] ?? null
                ];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            return null;
        }
    }
}
