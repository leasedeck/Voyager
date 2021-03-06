<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLeasesTable
 */
class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('leases', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('huurder_id');
            $table->unsignedBigInteger('status');
            $table->date('eind_datum');
            $table->date('start_datum');
            $table->integer('aantal_personen');
            $table->text('extra_informatie');
            $table->timestamps();

            // Indexes
            $table->foreign('huurder_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
}
