<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('familieleden', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->date('geboortedatum');
            $table->unsignedBigInteger('familie_id');
            $table->unsignedBigInteger('soort_lid_id');
            $table->foreign('familie_id')->references('id')->on('families');
            $table->foreign('soort_lid_id')->references('id')->on('soort_leden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('familieleden');
    }
};
