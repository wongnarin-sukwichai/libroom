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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('pic')->nullable();
            $table->integer('loc_id');
            $table->integer('con_id');
            $table->string('title');
            $table->integer('limit')->nullable()->comment('เข้าใช้บริการได้ไม่ต่ำกว่า');
            $table->integer('time')->comment('จำนวนเวลา จำนวน column เวลาทั้งหมด');
            $table->string('start')->comment('เวลาเริ่มต้น');
            $table->string('end')->comment('เวลาสิ้นสุด');
            $table->integer('status')->comment('0=เปิดใช้งาน, 1=ปิด');
            $table->string('created')->nullable()->comment('แก้ไขข้อมูลล่าสุด');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
