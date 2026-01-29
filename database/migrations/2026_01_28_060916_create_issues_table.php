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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('assignee_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('status')->default('open');
            $table->unsignedTinyInteger('priority');
            $table->double('working_hour')->default(0);
            $table->timestamps();
            $table->index(['project_id', 'assignee_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
