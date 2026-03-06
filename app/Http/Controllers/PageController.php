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

            $employees = getJsonData("employees.json");
            $employee = [];
            foreach ($employees as $key => $value) {
                if ($value["employee"] == $validated["employee"]) {
                    $employee = $value;
                }
            }
            // dd($employees, $employee, $employee_num);
            if (empty($employee)) {
                return ErrorResponse(400, "Empleado no encontrado", __METHOD__, $request);
            }
            $data = $employee;

            return SuccessResponse(200, "Fecha actualizada", __METHOD__, $data);
        } catch (Exception $e) {
            return ErrorResponse(400, $e->getMessage(), __METHOD__, $request);
        }
    }
    public function index()
    {
        $templates = [];
        $content = getJsonData("templates/templates.json");
        foreach ($content as $key => $template) {
            $name = $template["TemplateName"];
            $image = $template["image"];
            $templateObj["name"] = $name;
            $templateObj["filename"] = "";
            $templateObj["image"] = $image;
            $templateObj["content"] = json_encode($template);
            $templates[] = $templateObj;
        }
        // dd($templates);
        $data["templates"] = $templates;


        return view('pages.request', $data);
    }
}
