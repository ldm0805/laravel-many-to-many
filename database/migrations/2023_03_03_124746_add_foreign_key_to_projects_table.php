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
        Schema::table('projects', function (Blueprint $table) {
            //Creiamo la colonna per la foeing key
            $table->unsignedBigInteger('type_id') //coincidere
                ->nullable()
                ->after('id');
            //creo la foreign key
            $table->foreign('type_id')//coincidere
                ->references('id') //nome colonna di riferimento
                ->on('types') //quale tabella appartiene
                ->onDelete('set null'); //diciamo esplicitamente di settare a null la colonna nel caso in cui cancellassimo la categoria
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
        //passsaggio
        $table->dropForeign('projects_type_id_foreign'); //droppa nella tabella projects la colonna category_id che è la foreign key
        //2 passaggio
        $table->dropColumn('type_id');
        });
    }
};
