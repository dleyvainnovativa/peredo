<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class TemplateController extends Controller
{
    public static function vacations($contisign, $request)
    {
        $moreTags = self::buildMoreTags($request);

        $limit_date = date('Y-d-m', strtotime('+1 month'));

        // "2025-10-25"
        // === 1. Create UniKey ===
        $uniKeyPayload = [
            "UniKey" => "U001PROMEX_FV",
            "thisTemplateId" => "363bff6d-aa5d-4065-b66e-dd011759e5b9",
            "user_id" => "e5127f46-e604-4f27-811e-f8cba04591f5",
            "version" => false
        ];
        $uniKeyData = $contisign->createUniKey($uniKeyPayload);

        // === 2. Create DataTemplate ===
        $dataTemplatePayload = [
            "Active" => true,
            "annexed" => [],
            "Signsstatus" => "Este documento no ha sido firmado",
            "contract_id" => $uniKeyData['contractId'],
            "DataTemplates" => [
                "nomsolicitante" => "",
                "fechahoy" => "",
                "noempsol" => "",
                "turnosol" => "",
                "puesto" => "",
                "areasol" => "",
                "tipopago" => "",
                "fechapersol" => "",
                "diasol" => "",
                "fchsl" => "",
                "nomjfdirecto" => ""
            ],
            "DocumentName" => "Solicitud vacaciones de " . $request->employee_name,
            "dtperson_id" => $uniKeyData['personId'],
            "Tags" => [
                "promex",
                "sistemas",
                "contino",
                "u001promex_fv",
                "00.",
                "1promex_formato",
                "de",
                "vacaciones",
                "solicitud_vacaciones",
                ...$moreTags
            ],
            "Emptytemplate" => null,
            "user_id" => "e5127f46-e604-4f27-811e-f8cba04591f5",
            "positionRequired" => true,
            "UniKey" => $uniKeyData['unikey'],
            "html" => json_decode($request->html),
            "templateId" => "363bff6d-aa5d-4065-b66e-dd011759e5b9",
            "documentUrl" => null,
            "ConstancePSC" => false,
            "OnlyNOM151" => false,
            "Fields" => null,
            "signatures" => [
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "9b039999",
                    "x" => 240,
                    "y" => 558,
                    "width" => 111,
                    "height" => 49.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 240,
                        "y" => 558,
                        "width" => 111,
                        "height" => 49.5,
                        "bgcolor" => "#9b039999",
                        "name" => "Sistemas Contino",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma sencilla"
                ],
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "9b039999",
                    "x" => 240,
                    "y" => 558,
                    "width" => 111,
                    "height" => 49.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 240,
                        "y" => 558,
                        "width" => 111,
                        "height" => 49.5,
                        "bgcolor" => "#9b039999",
                        "name" => "Sistemas Contino",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma autógrafa"
                ],
                [
                    "Name" => "Ángel Chavez",
                    "Email" => "achavez@sistemascontino.com.mx",
                    "Charge" => "Notification",
                    "Position" => " ",
                    "BusinessName" => " ",
                    "Order" => null,
                    "external" => false,
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "bgcolor" => "#undefined",
                        "name" => "Ángel Chavez"
                    ],
                    "Type" => "Firma sencilla",
                    "LimitDate" => $limit_date
                ]
            ]

        ];
        $dataTemplateData = $contisign->createDataTemplate($dataTemplatePayload);

        // === 3. Send Signs ===
        $signsPayload = [
            "signs" => [
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "9b039999",
                    "x" => 240,
                    "y" => 558,
                    "width" => 111,
                    "height" => 49.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 240,
                        "y" => 558,
                        "width" => 111,
                        "height" => 49.5,
                        "bgcolor" => "#9b039999",
                        "name" => "Sistemas Contino",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma sencilla",
                    "documentid" => $dataTemplateData['id']
                ],
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "9b039999",
                    "x" => 240,
                    "y" => 558,
                    "width" => 111,
                    "height" => 49.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 240,
                        "y" => 558,
                        "width" => 111,
                        "height" => 49.5,
                        "bgcolor" => "#9b039999",
                        "name" => "Sistemas Contino",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma autógrafa",
                    "documentid" => $dataTemplateData['id']
                ],
                [
                    "Name" => "Ángel Chavez",
                    "Email" => "achavez@sistemascontino.com.mx",
                    "Charge" => "Notification",
                    "Position" => " ",
                    "BusinessName" => " ",
                    "Order" => null,
                    "external" => false,
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "bgcolor" => "#undefined",
                        "name" => "Ángel Chavez"
                    ],
                    "Type" => "Firma sencilla",
                    "LimitDate" => $limit_date,
                    "documentid" => $dataTemplateData['id']
                ]
            ],

            "firmas" => 999999
        ];
        $signsData = $contisign->sendSigns($signsPayload);

        $data = [
            'unikey' => $uniKeyData['unikey'],
            'documentId' => $dataTemplateData['id'],
            'message' => $signsData['Message'] ?? 'Documento generado correctamente'
        ];
        return $data;
    }
    public static function vacations2($contisign, $request)
    {
        $moreTags = self::buildMoreTags($request);
        $limit_date = date('Y-d-m', strtotime('+1 month'));
        // === 1. Create UniKey ===
        $uniKeyPayload = [
            "UniKey" => "U001PROMEX_FV_2",
            "thisTemplateId" => "a92fb2fc-6367-4051-ab03-7c6519c7820e",
            "user_id" => "e5127f46-e604-4f27-811e-f8cba04591f5",
            "version" => false
        ];
        $uniKeyData = $contisign->createUniKey($uniKeyPayload);

        // === 2. Create DataTemplate ===
        $dataTemplatePayload = [
            "Active" => true,
            "annexed" => [],
            "Signsstatus" => "Este documento no ha sido firmado",
            "contract_id" => $uniKeyData['contractId'],
            "DataTemplates" => [
                "nomsolicitante" => "",
                "fechahoy" => "",
                "noempsol" => "",
                "turnosol" => "",
                "puesto" => "",
                "areasol" => "",
                "tipopago" => "",
                "fechapersol" => "",
                "diasol" => "",
                "nomjfdirecto" => "",
                "cmjf" => ""
            ],
            "DocumentName" => "Solicitud vacaciones de " . $request->employee_name,
            "dtperson_id" => $uniKeyData['personId'],
            "Tags" => [
                "promex",
                "sistemas",
                "contino",
                "u001promex_fv2",
                "00.",
                "1promex_formato",
                "de",
                "vacaciones",
                "solicitud_vacaciones",
                ...$moreTags
            ],
            "Emptytemplate" => null,
            "user_id" => "e5127f46-e604-4f27-811e-f8cba04591f5",
            "positionRequired" => true,
            "UniKey" => $uniKeyData['unikey'],
            "html" => json_decode($request->html),
            "templateId" => "a92fb2fc-6367-4051-ab03-7c6519c7820e",
            "documentUrl" => null,
            "ConstancePSC" => false,
            "OnlyNOM151" => false,
            "Fields" => null,
            "signatures" => [
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 2,
                    "external" => true,
                    "bgColor" => "1867cd99",
                    "x" => 235.625,
                    "y" => 476.875,
                    "width" => 129.5,
                    "height" => 56.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 235.625,
                        "y" => 476.875,
                        "width" => 129.5,
                        "height" => 56.5,
                        "bgcolor" => "#1867cd99",
                        "name" => "Daniel Leyva",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma sencilla"
                ],
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 2,
                    "external" => true,
                    "bgColor" => "1867cd99",
                    "x" => 235.625,
                    "y" => 476.875,
                    "width" => 129.5,
                    "height" => 56.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 235.625,
                        "y" => 476.875,
                        "width" => 129.5,
                        "height" => 56.5,
                        "bgcolor" => "#1867cd99",
                        "name" => "Daniel Leyva",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma autógrafa"
                ],
                [
                    "Name" => $request->employee_name,
                    "Email" => $request->employee_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "7905f199",
                    "x" => 232.875,
                    "y" => 710.125,
                    "width" => 132.5,
                    "height" => 55.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Esperando",
                    "AditionalInformation" => [
                        "x" => 232.875,
                        "y" => 710.125,
                        "width" => 132.5,
                        "height" => 55.5,
                        "bgcolor" => "#7905f199",
                        "name" => "USUARIO DEMO (No Información confidencial)",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma sencilla"
                ],
                [
                    "Name" => $request->employee_name,
                    "Email" => $request->employee_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "7905f199",
                    "x" => 232.875,
                    "y" => 710.125,
                    "width" => 132.5,
                    "height" => 55.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Esperando",
                    "AditionalInformation" => [
                        "x" => 232.875,
                        "y" => 710.125,
                        "width" => 132.5,
                        "height" => 55.5,
                        "bgcolor" => "#7905f199",
                        "name" => "USUARIO DEMO (No Información confidencial)",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma autógrafa"
                ],
                [
                    "Name" => "Ángel Chavez",
                    "Email" => "achavez@sistemascontino.com.mx",
                    "Charge" => "Notification",
                    "Position" => " ",
                    "BusinessName" => " ",
                    "Order" => null,
                    "external" => false,
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "bgcolor" => "#undefined",
                        "name" => "Ángel Chavez"
                    ],
                    "Type" => "Firma sencilla",
                    "LimitDate" => $limit_date
                ]
            ]

        ];
        $dataTemplateData = $contisign->createDataTemplate($dataTemplatePayload);

        // === 3. Send Signs ===
        $signsPayload = [
            "signs" => [
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 2,
                    "external" => true,
                    "bgColor" => "1867cd99",
                    "x" => 235.625,
                    "y" => 476.875,
                    "width" => 129.5,
                    "height" => 56.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 235.625,
                        "y" => 476.875,
                        "width" => 129.5,
                        "height" => 56.5,
                        "bgcolor" => "#1867cd99",
                        "name" => "Sistemas Contino",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma sencilla",
                    "documentid" => $dataTemplateData['id']
                ],
                [
                    "Name" => $request->leader_name,
                    "Email" => $request->leader_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 2,
                    "external" => true,
                    "bgColor" => "1867cd99",
                    "x" => 235.625,
                    "y" => 476.875,
                    "width" => 129.5,
                    "height" => 56.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "x" => 235.625,
                        "y" => 476.875,
                        "width" => 129.5,
                        "height" => 56.5,
                        "bgcolor" => "#1867cd99",
                        "name" => "Sistemas Contino",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma autógrafa",
                    "documentid" => $dataTemplateData['id']
                ],
                [
                    "Name" => $request->employee_name,
                    "Email" => $request->employee_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "7905f199",
                    "x" => 232.875,
                    "y" => 710.125,
                    "width" => 132.5,
                    "height" => 55.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Esperando",
                    "AditionalInformation" => [
                        "x" => 232.875,
                        "y" => 710.125,
                        "width" => 132.5,
                        "height" => 55.5,
                        "bgcolor" => "#7905f199",
                        "name" => "USUARIO DEMO (No Información confidencial)",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma sencilla",
                    "documentid" => $dataTemplateData['id']
                ],
                [
                    "Name" => $request->employee_name,
                    "Email" => $request->employee_email,
                    "Charge" => "Signed",
                    "Position" => "",
                    "BusinessName" => "",
                    "Order" => 1,
                    "external" => true,
                    "bgColor" => "7905f199",
                    "x" => 232.875,
                    "y" => 710.125,
                    "width" => 132.5,
                    "height" => 55.5,
                    "dimension" => [
                        "w" => 599,
                        "h" => 846
                    ],
                    "Status" => "Esperando",
                    "AditionalInformation" => [
                        "x" => 232.875,
                        "y" => 710.125,
                        "width" => 132.5,
                        "height" => 55.5,
                        "bgcolor" => "#7905f199",
                        "name" => "USUARIO DEMO (No Información confidencial)",
                        "dimensions" => [
                            "w" => 599,
                            "h" => 846
                        ]
                    ],
                    "currentUserExternal" => true,
                    "LimitDate" => $limit_date,
                    "Type" => "Firma autógrafa",
                    "documentid" => $dataTemplateData['id']
                ],
                [
                    "Name" => "Ángel Chavez",
                    "Email" => "achavez@sistemascontino.com.mx",
                    "Charge" => "Notification",
                    "Position" => " ",
                    "BusinessName" => " ",
                    "Order" => null,
                    "external" => false,
                    "Status" => "Pendiente",
                    "AditionalInformation" => [
                        "bgcolor" => "#undefined",
                        "name" => "Ángel Chavez"
                    ],
                    "Type" => "Firma sencilla",
                    "LimitDate" => $limit_date,
                    "documentid" => $dataTemplateData['id']
                ]


            ],

            "firmas" => 999999
        ];
        $signsData = $contisign->sendSigns($signsPayload);

        $data = [
            'unikey' => $uniKeyData['unikey'],
            'documentId' => $dataTemplateData['id'],
            'message' => $signsData['Message'] ?? 'Documento generado correctamente'
        ];
        return $data;
    }
    public static function buildMoreTags($request)
    {
        $tags = [];

        // Attributes you want to skip
        $except = [
            'html',
            '_token',
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
}
