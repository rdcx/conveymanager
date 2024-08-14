<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            // Polymorphic relationship
            $table->uuidMorphs('documentable');

            $table->string('file_path');
            $table->string('file_name');
            $table->foreignUuid('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->enum('document_type', ['contract', 'title_deed', 'survey', 'other']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}