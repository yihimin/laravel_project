<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id(); // 자동 증가 기본키
            $table->string('name', 20);
            $table->string('phone', 11);
            $table->string('gender', 10);
            $table->timestamps();
        });
    }
    
};
