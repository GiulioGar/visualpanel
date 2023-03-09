<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TargetAssociation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('target_association', function (Blueprint $table)
         {
            $table->bigIncrements('id')->unique();
            $table->string('prj',10)->nullable();
            $table->string('sid',20)->nullable();
            $table->string('questionCode',20)->nullable();
            $table->string('optionCode',50)->nullable();
            $table->timestamps();
            $table->bigInteger('targetId')->unsigned();
            $table->foreign("targetId")->references("id")->on("target_list")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_association');
    }
}
