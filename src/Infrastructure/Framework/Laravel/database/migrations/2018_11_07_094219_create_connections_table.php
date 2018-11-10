<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->string('user_id1', 10);
            $table->string('user_id2', 10);
            $table->timestamps();
            $table->primary(['user_id1', 'user_id2']);
            $table->foreign('user_id1')->references('id')->on('users');
            $table->foreign('user_id2')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
}