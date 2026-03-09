<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContisignService;

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
                'date_limit' => 'required|date',
                'template_id' => 'required|string',
                // 'employee_num' => 'required|string',
                // 'employee_position' => 'required|string',
                // 'employee_department' => 'required|string',
                'employee_name' => 'required|string',
                'employee_email' => 'required|email',
                // 'leader_name' => 'required|string',
                // 'leader_email' => 'required|email',
            ]);

            // $template_id = $request["template_id"];
            $template_id = $request->input("template_id");
            // dd($template_id);


            // dd($request, json_decode($request["html"]));
            // SuccessResponse(200, "aasdasd", null, $request);

            // === Login ===
            $email = env('CONTISIGN_EMAIL');
            $password = env('CONTISIGN_PASSWORD');
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
            $data = TemplateController::template($this->contisign, $signatures, $template, $fields, $html, $request);


            // dd(TemplateController::buildMoreTags($request));

            // switch ($template_id) {
            //     case '363bff6d-aa5d-4065-b66e-dd011759e5b9':
            //         $data = TemplateController::vacations($this->contisign, $request);
            //         # code...
            //         break;
            //     case 'a92fb2fc-6367-4051-ab03-7c6519c7820e':
            //         $data = TemplateController::vacations2($this->contisign, $request);
            //         # code...
            //         break;

            //     default:
            //         # code...
            //         break;
            // }

            // dd($data);


            return SuccessResponse(200, "Fecha actualizada", __METHOD__, $data);
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
