<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('imagem');
            $table->string('video_trailer_url');
            $table->string('titulo');
            $table->float('progresso');
            $table->float('idioma');
            $table->integer('tempo_curso');
            $table->integer('quantidade_aulas');
            $table->string('descricao');
            $table->string('observacoes');
            $table->string('categoria_id');
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
        Schema::dropIfExists('cursos');
    }
}
