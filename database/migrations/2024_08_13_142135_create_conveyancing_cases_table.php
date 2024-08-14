<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveyancingCasesTable extends Migration
{
    public function up()
    {
        Schema::create('conveyancing_cases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ref', 14)->unique();
            $table->foreignUuid('property_id')->constrained('properties')->onDelete('cascade');
            $table->foreignUuid('conveyancer_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['initiated', 'in_progress', 'completed', 'cancelled']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conveyancing_cases');
    }
}
