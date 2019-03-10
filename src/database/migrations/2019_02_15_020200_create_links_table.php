<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stratus_links', function (Blueprint $table){
            // Mariadb unique hack
            $table->engine='innodb ROW_FORMAT=DYNAMIC';
            // Columns
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('expire_at')->nullable();
            $table->string('password')->nullable();
            $table->morphs('linkable');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stratus_links');
    }
}