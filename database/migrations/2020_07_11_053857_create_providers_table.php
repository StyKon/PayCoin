<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('companyname');
            $table->string('slug')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('adresse');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
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
        Schema::dropIfExists('providers');
    }
}
