<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Request extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'rfc',
        'email',
        'celular',
        'numero_empleado',
        'monto_prestamo',
        'uuid_ultimo_pago',
        'id_promotor',
        'id_empresa',
        'id_documento',
        'id_contisign',
        'unikey',
        'document_url',
        'template_id',
    ];
}
