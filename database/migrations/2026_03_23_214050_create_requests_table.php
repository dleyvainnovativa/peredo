<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');

            $table->string('rfc', 13)->nullable();
            $table->string('email');
            $table->string('celular', 15)->nullable();

            $table->string('numero_empleado')->nullable();
            $table->text('status')->nullable();
            $table->decimal('monto_prestamo', 10, 2)->nullable();

            $table->string('uuid_ultimo_pago')->nullable();
            $table->unsignedBigInteger('id_promotor');

            $table->unsignedBigInteger('id_empresa')->nullable();
            $table->unsignedBigInteger('id_documento')->nullable();
            $table->string('id_contisign')->nullable();

            $table->string('unikey')->nullable();
            $table->text('document_url')->nullable();
            $table->text('template_id')->nullable();
            $table->text('peredo_id')->nullable();
            $table->text('peredo_folio')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
