<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTenantsTable
 */
class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {

        //  "adres" => null
        //  "postcode" => null
        //  "stad" => null
        //  "land" => null

        Schema::create('tenants', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('land_id');
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('email');
            $table->string('adres');
            $table->string('postcode', 20);
            $table->string('stad');
            $table->timestamps();

            // Indexes
            $table->foreign('land_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
