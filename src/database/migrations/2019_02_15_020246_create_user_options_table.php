<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUserOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stratus_user_options', function (Blueprint $table){
            // Mariadb unique hack
            $table->engine='innodb ROW_FORMAT=DYNAMIC';
            // Columns
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->boolean('notify_file')->default(false);
            $table->boolean('notify_folder')->default(false);
            $table->boolean('notify_add')->default(false);
            $table->boolean('email')->default(false);
            // Constraints
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stratus_user_options');
    }
}