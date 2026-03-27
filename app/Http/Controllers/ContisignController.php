<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContisignService;
use Illuminate\Support\Str;

class ContisignController extends Controller
{
    protected $contisign;

    public function __construct(ContisignService $contisign)
    {
        $this->contisign = $contisign;
    }

    public function generateDocument(Request $request)
    {
        try {
            $request->validate([
                'html' => 'required|string',
                'template_id' => 'required|string',
                'annexed' => 'nullable|file',
                'employee_name' => 'required|string',
                'employee_email' => 'required|email',
                'promotor_email' => 'required|email',
                'employee_phone' => 'required|string',

                'document_id' => 'required|string',
                'company_id' => 'required|string',

                'employee_firstname' => 'required|string',
                'employee_lastname' => 'required|string',
                'employee_lastname2' => 'required|string',
                'employee_rfc' => 'required|string',

            ]);

            // $template_id = $request["template_id"];
            $template_id = $request->input("template_id");
            $email = env('CONTISIGN_EMAIL');
            $password = env('CONTISIGN_PASSWORD');

            $id = (string) Str::uuid();

            $obj = [
                'id' => $id,
                'nombre' => $request->input("employee_firstname"),
                'apellido_paterno' => $request->input("employee_lastname"),
                'apellido_materno' => $request->input("employee_lastname2"),
                'rfc' => $request->input("employee_rfc"),
                'email' => $request->input("employee_email"),
                'celular' => $request->input("employee_phone"),
                'numero_empleado' => $request->input("employee_num"),
                'monto_prestamo' => $request->input("employee_amount"),
                'uuid_ultimo_pago' => $request->input("employee_lastid"),
                'id_promotor' => $request->input("promotor_id"),
                'id_empresa' => $request->input("company_id"),
                'id_documento' => $request->input("document_id"),
                'id_contisign' => null,
                'unikey' => null,
                'document_url' => null,
                'status' => null,
                'template_id' => $template_id,
            ];
            // dd($obj);

            $this->contisign->login($email, $password);

            $template = self::getTemplate($template_id);
            $signatures = [
                [
                    "type" => "CLIENTE",
                    "email" => $request->input("employee_email"),
                    "name" => $request->input("employee_name"),
                ],
                [
                    "type" => "PROMOTOR",
                    "email" => $request->input("promotor_email"),
                    "name" => $request->input("promotor_name"),
                    // "email" => "caballerodlc@outlook.com",
                    // "name" => "Daniel Leyva"
                ],
                [
                    "type" => "ARCHIVO",
                    "email" => $request->input("employee_email"),
                    "name" => $request->input("employee_name"),
                ],
            ];
            $fields = json_decode($request->input("fields"), true);

            $data = [];
            $html = $request->input("html");
            $annexed = $request->file('annexed');

            $peredo = PeredoController::setDatosSolicitud($obj);

            $obj["peredo_id"] = $peredo->id;
            $obj["peredo_folio"] = $peredo->folio;

            // RequestController::store($obj);
            // return SuccessResponse(200, "Documento generado", __METHOD__, $obj);
            $data = TemplateController::template($this->contisign, $signatures, $template, $fields, $html, $request, $annexed, $obj, $peredo);
            return SuccessResponse(200, "Documento generado", __METHOD__, [$obj, $peredo, $data]);
        } catch (\Exception $e) {
            return ErrorResponse(400, $e->getMessage(), __METHOD__, $request);
            // return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private static function getTemplate($id)
    {
        $content = getJsonData("templates/templates.json");
        $template = [];
        foreach ($content as $key => $templateContent) {
            if ($templateContent["id"] == $id) {
                $template = $templateContent;
            }
        }
        return $template;
    }

    public function test(Request $request)
    {
        try {
            $companyId = 'e5127f46-e604-4f27-811e-f8cba04591f5';
            $startDate = '2025-09-01';
            $endDate = '2025-09-30';

            // Login using credentials from .env
            $email = env('CONTISIGN_EMAIL');
            $password = env('CONTISIGN_PASSWORD');
            $this->contisign->login($email, $password);

            // Call the compareconsumables endpoint
            $data = $this->contisign->testCompareConsumables($companyId, $startDate, $endDate);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
