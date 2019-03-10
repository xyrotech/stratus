<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateClamavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stratus_clamav', function (Blueprint $table){
            // Columns
            $table->increments('id');
            $table->timestamps();
            $table->string('type');
            $table->ipAddress('remote_addr');
            $table->integer('folder_id')->unsigned()->nullable();
            // Constraints
            $table->foreign('folder_id')->references('id')->on('stratus_folders');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stratus_clamav');
    }
}