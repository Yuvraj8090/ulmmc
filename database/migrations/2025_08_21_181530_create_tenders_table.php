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
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();

            // Titles
            $table->string('title_en');  // English title
            $table->string('title_hi');  // Hindi title

            // Descriptions
            $table->text('description_en')->nullable();
            $table->text('description_hi')->nullable();

            // Tender dates
            $table->date('open_date')->nullable();
            $table->date('close_date')->nullable();

            // File path (store filename/path of uploaded file)
            $table->string('file_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
