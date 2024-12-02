<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('photo_before')->nullable(); // Фото "до"
            $table->string('photo_after')->nullable();  // Фото "после"
        });
    }
    
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['photo_before', 'photo_after']);
        });
    }
    
};
