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
        Schema::create('general_record_to_general_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_general_record_id');
            $table->foreign('parent_general_record_id', 'id_of_parent_general_record')->references('id')->on('general_records')->constrained('general_records')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('child_general_record_id');
            $table->foreign('child_general_record_id', 'id_of_child_general_record')->references('id')->on('general_records')->constrained('general_records')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_record_to_general_record');
    }
};
