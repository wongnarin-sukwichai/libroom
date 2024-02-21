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
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('loc_id');
            $table->integer('con_id');
            $table->integer('room_id');
            $table->integer('time');
            $table->string('uid');
            $table->string('name');
            $table->string('surname');
            $table->string('faculty')->nullable()->comment('คณะ');
            $table->string('major')->nullable()->comment('สาขาวิชา');
            $table->string('code')->comment('code ยกเลิกห้อง');
            $table->integer('status')->nullable()->comment('0=จอง, 1=ยืนยัน');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
