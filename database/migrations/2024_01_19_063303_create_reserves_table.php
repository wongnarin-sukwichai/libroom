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
            $table->string('uid');
            $table->string('name');
            $table->string('surname');
            $table->string('faculty')->nullable()->comment('คณะ');
            $table->string('major')->nullable()->comment('สาขาวิชา');
            $table->integer('loc_id');
            $table->integer('hall_id');
            $table->integer('room_id');
            $table->integer('time');
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
