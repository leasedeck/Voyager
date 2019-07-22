<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 *  Class CreateLokalenstable 
 */
class CreateLokalensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('lokalens', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('verantwoordelijke_algemeen')->nullable();
            $table->unsignedBigInteger('verantwoordelijke_onderhoud')->nullable();
            $table->boolean('werkpunten_beheer')->default(false);
            $table->string('naam');
            $table->string('aantal_personen');
            $table->string('capaciteits_type');
            $table->timestamps();

            // Foreign keys
            $table->foreign('verantwoordelijke_algemeen')->references('id')->on('users')->onDelete('set_null');
            $table->foreign('verantwoordelijke_onderhoud')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lokalens');
    }
}
