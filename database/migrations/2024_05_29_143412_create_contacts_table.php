<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned;
            $table->foreign('id_user')->references('id')->on('users');
            $table->String('name');
            $table->String('email');
            $table->String('subject');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Run the migrations
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
    
}

