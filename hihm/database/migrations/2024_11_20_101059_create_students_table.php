<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // 번호
            $table->string('name', 20); // 이름
            $table->string('phone', 11); // 전화번호
            $table->string('ban', 10); // 반 (콤보 상자 값)
            $table->timestamps();
        });
    }    
};
