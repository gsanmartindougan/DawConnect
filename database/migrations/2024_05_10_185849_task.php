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
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->boolean('done');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('state');
        });
    }
};
