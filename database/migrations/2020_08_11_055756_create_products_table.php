<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('cantidad')->unsigned()->default(0);
            $table->decimal('precio_actual' ,12,2)->default(0);
            $table->decimal('precio_anterior',12,2)->default(0);
            $table->integer('porcentaje_descuento')->default(0);
            $table->text('descripcion_corta')->nullable();
            $table->text('descripcion_larga')->nullable();
            $table->text('datos_interes')->nullable();
            $table->text('especificaciones');
            $table->unsignedBigInteger('visitas')->default(0);
            $table->unsignedBigInteger('ventas')->default(0);
            $table->string('estado');    
            $table->char('activo',2);
            $table->char('slideprincipal',2);
            $table->foreign('category_id')->references('id')->on('categories');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
