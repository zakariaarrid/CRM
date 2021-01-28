<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('etat');
            $table->integer('validated_by')->nullable();
            $table->string('tracknumber')->nullable();
            $table->string('nom_prenom')->nullable();
            $table->string('phone')->nullable();
            $table->string('ville')->nullable();
            $table->string('adress')->nullable();
            $table->float('prix')->nullable();
            $table->integer('day1')->default(0);
            $table->integer('day2')->default(0);
            $table->integer('day3')->default(0);
            $table->string('produit')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('commandes');
    }
}
