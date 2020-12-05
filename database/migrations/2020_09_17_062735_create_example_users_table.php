<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExampleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('example_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('example_id');
            $table->unsignedInteger('user_id');
            $table->text('body')->nullable();
            $table->text('files')->nullable();
            $table->string('rate')->nullable()->default('pending');
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
        Schema::dropIfExists('example_user');
    }
}
