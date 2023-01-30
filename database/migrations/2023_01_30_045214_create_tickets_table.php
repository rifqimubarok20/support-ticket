<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreignId('client_id')->references('id')->on('client')->onDelete('cascade');
            $table->longText('issue');
            $table->string('file');
            $table->foreignId('user_id')->nullable()->references('id')->on('user')->onDelete('cascade');
            $table->enum('status', ['to do', 'on progress', 'testing', 'staging', 'done'])->default('to do');
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
