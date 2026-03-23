<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Exception;

class RequestController extends Controller
{

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
}
