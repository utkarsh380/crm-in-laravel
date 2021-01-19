<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('clientName')->nullable();
            $table->string('clientEmail')->nullable();
            $table->string('leadSource')->nullable();
            $table->string('leadStatus')->nullable();
            $table->string('generatedBy')->nullable();
            $table->string('salesPerson')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('organization')->nullable();
            $table->string('leadType')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
