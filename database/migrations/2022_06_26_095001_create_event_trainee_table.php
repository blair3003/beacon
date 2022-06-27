<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_trainee', function (Blueprint $table) {
            $table->primary(['event_id', 'trainee_id']);
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trainee_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_trainee');
    }
};