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
        Schema::create('ourclients', function (Blueprint $table) {
            $table->id();
            $table->string('company_name' ,255)->unique();
            $table->string('logo' , 255);
            $table->string('url' , 255)->nullable();
            $table->enum('status' , [0,1]);
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
        Schema::dropIfExists('ourclients');
    }
};
