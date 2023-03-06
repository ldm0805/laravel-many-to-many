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
        Schema::create('project_tag', function (Blueprint $table) {
            $table->id();
            //creo la colonna per il project
            $table->unsignedBigInteger('project_id');
            //creo la colonna per il foreign
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            //creo la colonna per il tag
            $table->unsignedBigInteger('tag_id');
            //creo la colonna per la foreign
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_tag');
    }
};
