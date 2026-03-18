<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $templates = [];
        $content = getJsonData("templates/templates.json");
        $documentsRaw = getJsonData("company/documents.json");
        $documents = [];
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
                "doc_id" => self::getTemplateID($doc['DOCUMENTO']),
                "documento" => $doc['DOCUMENTO'],
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
}
