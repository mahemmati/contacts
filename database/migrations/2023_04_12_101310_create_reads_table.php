<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reads', function (Blueprint $table) {
            $table->id();
            $table->dateTime('read_at');
            $table->unsignedBigInteger('contact_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reads');
    }
};
