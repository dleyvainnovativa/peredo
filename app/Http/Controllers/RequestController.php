<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Services\ContisignService;
use Exception;
use Carbon\Carbon;

class RequestController extends Controller
{

    protected $contisign;

    public function __construct(ContisignService $contisign)
    {
        $this->contisign = $contisign;
    }

    public static function store($data)
    {
        try {
            $record = Request::create($data);
            return $record;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            // throw new Exception("No se ha logrado crear el registro");
        }
    }
    public static function updateStatus(string $id, string $status)
    {
        return Request::where('id', $id)->update([
            'status' => $status
        ]);
    }
    // public  function validate()
    // {
    //     try {
    //         $documents = [];
    //         $requests = Request::where('status', '!=', 'Totalmente firmado')->get();
    //         foreach ($requests as $key => &$request) {
    //             if ($request->status != "Totalmente firmado") {
    //                 $document = $this->contisign->getDocument($request->id_contisign);
    //                 if (
    //                     $document["Signsstatus"] == "Este documento no ha sido firmado" ||
    //                     $document["Signsstatus"] == "Parcialmente firmado" ||
    //                     $document["Signsstatus"] == "Totalmente firmado"
    //                 ) {
    //                     $obj["peredo_id"] = $request->peredo_id;
    //                     $obj["id_contisign"] = $request->id_contisign;
    //                     $obj["peredo_folio"] = $request->peredo_folio;
    //                     $obj["status"] = $document["Signsstatus"];
    //                     $obj["client_url"] = null;
    //                     $obj["client_date"] = null;
    //                     $obj["promotor_url"] = null;
    //                     $obj["constancy_url"] = $document["ConstancyRC"];
    //                     $obj["document_url"] = $document["documentUrl"];
    //                     $obj["document_start"] = $document["created_at"];
    //                     $obj["promotor_date"] = null;
    //                     $obj["document_end"] = null;
    //                     $obj["status"] = $document["Signsstatus"];
    //                     foreach ($document["signatures"] as $key => $signature) {
    //                         if ($signature["Charge"] == "Signed" && $signature["Type"] == "Firma autógrafa") {
    //                             if ($signature["Order"] == 1) {
    //                                 $obj["client_url"] = "https://www.contisign.com.mx/es/document/" . $signature["signToken"];
    //                                 if ($signature["Status"] == "Firmado") {
    //                                     $obj["client_date"] = $signature["updated_at"];
    //                                 }
    //                             }
    //                             if ($signature["Order"] == 2) {
    //                                 $obj["promotor_url"] = "https://www.contisign.com.mx/es/document/" . $signature["signToken"];
    //                                 if ($signature["Status"] == "Firmado") {
    //                                     $obj["promotor_date"] = $signature["updated_at"];
    //                                 }
    //                             }
    //                         }
    //                     }
    //                     if ($document["Signsstatus"] == "Totalmente firmado") {
    //                         $obj["document_end"] = $document["updated_at"];
    //                         self::updateStatus($request->id, "Totalmente firmado");
    //                     }
    //                     $updated = [
    //                         "id_solicitud" => $obj["peredo_id"],
    //                         "fecha_genera_doc" => self::formatDate($obj["document_start"]),
    //                         "id_contisign" => $obj["id_contisign"],
    //                         "estatus_contisign" => $obj["status"],
    //                         "liga_cliente" => $obj["client_url"],
    //                         "fecha_firma_cliente" => self::formatDate($obj["client_date"]),
    //                         "liga_promotor" => $obj["promotor_url"],
    //                         "fecha_firma_promotor" => self::formatDate($obj["promotor_date"]),
    //                         "rutaQR_XML" => $obj["constancy_url"],
    //                         "rutaQR_PDF" => $obj["document_url"]
    //                     ];
    //                     PeredoController::updateDatosSolicitud($updated);
    //                     array_push($documents, $updated);
    //                 }
    //             }
    //         }
    //         return $documents;
    //     } catch (Exception $e) {
    //         throw new Exception($e->getMessage());
    //     }
    // }
    // public static function formatDate($date)
    // {
    //     $formatted = null;
    //     if ($date) {
    //         $formatted = Carbon::parse($date)->format('d/m/Y H:i:s');
    //     }
    //     return $formatted;
    // }
}
