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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->uuid('from');
            $table->uuid('to');
            $table->text('content');
            $table->boolean('read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamp('sent_at')->nullable();         
            $table->timestamps();

            $table->foreign('from')->references('uuid')->on('users')->onDelete('cascade');
            $table->foreign('to')->references('uuid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
