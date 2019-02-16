<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table){
            // Mariadb unique hack
            $table->engine='innodb ROW_FORMAT=DYNAMIC';
            // Columns
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('token');
            $table->string('path');
            $table->integer('user_id')->unsigned();
            $table->integer('folder_id')->unsigned();
            $table->integer('size')->unsigned();
            $table->softDeletes();
            // Constraints
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('folder_id')->references('id')->on('folders');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}