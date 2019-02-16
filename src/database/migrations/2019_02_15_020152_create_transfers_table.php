<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table){
            // Mariadb unique hack
            $table->engine='innodb ROW_FORMAT=DYNAMIC';
            // Columns
            $table->increments('id');
            $table->ipAddress('remote_addr');
            $table->timestamps();
            $table->morphs('object');
            $table->boolean('direction');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}