/* Este fragmento de código PHP representa un archivo de migración en Laravel que utiliza Eloquent ORM
para operaciones de base de datos. Aquí hay un desglose de lo que hace el código: */
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idusuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('idlibro')->constrained('libros')->onDelete('cascade');
            $table->foreignId('idEstado')->constrained('estados')->onDelete('cascade');
            $table->integer('tiempo_semanas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
