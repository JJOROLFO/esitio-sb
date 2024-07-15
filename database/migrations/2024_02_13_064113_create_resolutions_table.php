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
        Schema::disableForeignKeyConstraints();

        Schema::create('resolutions', function (Blueprint $table) {
            $table->id();
            $table->date('res_date')->nullable();
            $table->string('res_no')->nullable();
            $table->string('series')->nullable();
            $table->text('subject')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('author_sponsors');
            $table->string('committee_in_charge')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->foreign('createdby')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->foreign('updatedby')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resolutions');
    }
};
