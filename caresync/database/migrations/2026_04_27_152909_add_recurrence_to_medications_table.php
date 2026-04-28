<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('medications', function (Blueprint $table) {
        $table->integer('frequency_hours')->default(0)->after('dosage'); 
        $table->integer('duration_days')->default(1)->after('frequency_hours'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medications', function (Blueprint $table) {
            //
        });
    }
};
