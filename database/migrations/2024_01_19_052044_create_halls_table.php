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
            $table->string('title');
            $table->longText('detail')->comment('รายละเอียด');
            $table->integer('limit')->comment('เข้าใช้บริการได้ไม่ต่ำกว่า');
            $table->integer('sum')->comment('จำนวนเวลา จำนวน column เวลาทั้งหมด');
            $table->integer('start')->comment('เวลาเริ่มต้น');
            $table->integer('time')->comment('เวลาเริ่มต้น **8');
            $table->integer('status')->comment('0=เปิดใช้งาน, 1=ปิด');
            $table->integer('created')->nullable()->comment('แก้ไขข้อมูลล่าสุด');
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
