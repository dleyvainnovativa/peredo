<?php

namespace App\Services;

use App\Models\Request;
use App\Services\ContisignService;
use App\Http\Controllers\PeredoController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RequestService
{
    protected $contisign;

    public function __construct(ContisignService $contisign)
    {
        $this->contisign = $contisign;
    }

    public function validateRequests()
    {
        $documents = [];
        $requests = Request::where('status', '!=', 'Totalmente firmado')->get();
        Log::debug(["Request DB"]);

        foreach ($requests as $request) {
            if ($request->status != "Totalmente firmado") {

                $document = $this->contisign->getDocument($request->id_contisign);

                /*NEW VALIDATION*/
                if ($document["Signsstatus"] != $request->status) {
                    if (
                        $document["Signsstatus"] == "Este documento no ha sido firmado" ||
                        $document["Signsstatus"] == "Parcialmente firmado" ||
                        $document["Signsstatus"] == "Documento rechazado" ||
                        $document["Signsstatus"] == "Totalmente firmado"
                    ) {

                        $obj = [
                            "peredo_id" => $request->peredo_id,
                            "id_contisign" => $request->id_contisign,
                            "peredo_folio" => $request->peredo_folio,
                            "status" => $document["Signsstatus"],
                            "client_url" => null,
                            "client_date" => null,
                            "promotor_url" => null,
                            "constancy_url" => $document["ConstancyRC"],
                            "document_url" => $document["documentUrl"],
                            "document_start" => $document["created_at"],
                            "promotor_date" => null,
                            "document_end" => null,
                        ];
                        $ineFile = null;
                        $selfieFile = null;

                        foreach ($document["annexed"] as $key => $annexed) {
                            if ($key == 0) {
                                $ineFile = $annexed["FieldUrl"];
                            }
                            if ($key == 1) {
                                $selfieFile = $annexed["FieldUrl"];
                            }
                        }

                        foreach ($document["signatures"] as $signature) {
                            if ($signature["Charge"] == "Signed" && $signature["Type"] == "Firma autógrafa") {

                                if ($signature["Order"] == 1) {
                                    $obj["client_url"] = "https://www.contisign.com.mx/es/document/" . $signature["signToken"];
                                    if ($signature["Status"] == "Firmado") {
                                        $obj["client_date"] = $signature["updated_at"];
                                    }
                                }

                                if ($signature["Order"] == 2) {
                                    $obj["promotor_url"] = "https://www.contisign.com.mx/es/document/" . $signature["signToken"];
                                    if ($signature["Status"] == "Firmado") {
                                        $obj["promotor_date"] = $signature["updated_at"];
                                    }
                                }
                            }
                        }

                        if ($document["Signsstatus"] == "Totalmente firmado") {
                            $obj["document_end"] = $document["updated_at"];
                        }
                        Request::where('id', $request->id)
                            ->update(['status' => $document["Signsstatus"]]);

                        $updated = [
                            "id_solicitud" => $obj["peredo_id"],
                            "fecha_genera_doc" => $this->formatDate($obj["document_start"]),
                            "id_contisign" => $obj["id_contisign"],
                            "estatus_contisign" => $obj["status"],
                            "liga_cliente" => $obj["client_url"],
                            "fecha_firma_cliente" => $this->formatDate($obj["client_date"]),
                            "liga_promotor" => $obj["promotor_url"],
                            "fecha_firma_promotor" => $this->formatDate($obj["promotor_date"]),
                            "rutaQR_XML" => $obj["constancy_url"],
                            "rutaQR_PDF" => $obj["document_url"],
                            "ruta_INE" => $ineFile,
                            "ruta_Selfie" => $selfieFile,
                        ];

                        PeredoController::updateDatosSolicitud($updated);
                        $documents[] = $updated;
                    }
                }
            }
        }

        return $documents;
    }

    private function formatDate($date)
    {
        return $date
            ? Carbon::parse($date)
            ->setTimezone('America/Mexico_City')
            ->format('d/m/Y H:i:s')
            : null;
    }
}
