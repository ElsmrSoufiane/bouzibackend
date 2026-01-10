<?php
// database/migrations/2025_01_01_create_sessions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course');
            $table->dateTime('datetime');
            $table->text('description');
            $table->enum('plan_type', ['group', 'individual', 'both'])->default('group');
            $table->integer('duration_minutes')->default(120);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};