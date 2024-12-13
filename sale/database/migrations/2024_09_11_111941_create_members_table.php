<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();  // 기본키 id
            
            $table->string('uid', 20);  // 사용자 아이디
            $table->string('pwd', 20);  // 비밀번호
            $table->string('name', 20);  // 이름
            $table->string('tel', 11)->nullable();  // 전화번호, null 허용
            $table->tinyinteger('rank')->nullable()->default(0);  // 등급, 기본값 0
            
            $table->timestamps();  // created_at, updated_at 타임스탬프
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
