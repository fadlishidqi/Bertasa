<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('image_detection_logs', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->string('prediction_result')->nullable();
            $table->float('confidence')->nullable();
            $table->enum('status', ['success', 'failed']);
            $table->string('ip_address')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('image_detection_logs');
    }
};