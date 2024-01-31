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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('time')->comment('จำนวนเวลา จำนวน column เวลาทั้งหมด');
            $table->string('start')->comment('** เวลาเริ่มต้น 08.00 **');
            $table->string('end')->nullable()->comment('** เวลาสิ้นสุด **');
            $table->string('created')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
