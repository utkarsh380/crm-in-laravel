<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplePermissionsTable extends Migration
{
    
    public function up()
    {
        Schema::create('sample_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('role_id')->unsigned();
            $table->bigInterger('permission_id')->unsigned();
            $tbale->boolean('create')->default(false);
            $tbale->boolean('edit')->default(false);
            $tbale->boolean('delete')->default(false);
            $tbale->boolean('view')->default(false);
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
        Schema::dropIfExists('sample_permissions');
    }
}
