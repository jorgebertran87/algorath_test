<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('name', 50);
            $table->timestamps();
            $table->primary('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
