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
        Schema::create('aml_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('conveyancing_case_id');
            $table->uuid('client_id');
            $table->boolean('success');
            $table->string('details')->nullable();
            $table->timestamps();

            $table->foreign('conveyancing_case_id')->references('id')->on('conveyancing_cases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
