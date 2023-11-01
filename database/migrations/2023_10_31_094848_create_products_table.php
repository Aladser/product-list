<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('articul', 255)->unique();
            $table->string('name', 255)->nullable(false);

            // считаю, что такая реализация лучше. Отсеивает лишние значения
            $table->enum('status', ['available', 'unavailable'])->default('available');

            $table->jsonb('data')->nullable('false');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
