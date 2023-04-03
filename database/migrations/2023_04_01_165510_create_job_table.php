<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('deadline')->nullable();
            $table->string('description')->nullable();
            $table->string('missions')->nullable();
            $table->string('profile_required')->nullable();
            $table->boolean('urgent')->default(false);
            $table->boolean('visibility')->default(true);
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('jobs');
    }
};
