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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('content_plan_id')->constrained()->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('platform')->nullable();
            $table->string('format')->nullable()->comment('e.g., image, video, text');
            $table->string('content_bucket')->nullable()->comment('e.g., marketing, education, entertainment');
            $table->longText('content_idea')->nullable()->comment('Brief description of the content idea');
            $table->string('idea_status')->default('pending')->comment('pending, approved, rejected');
            $table->longText('creative_copy')->nullable();
            $table->longText('visual_direction')->nullable();
            $table->longText('caption')->nullable();
            $table->string('copy_status')->default('pending')->comment('pending, approved, rejected');
            $table->string('creative_status')->default('pending')->comment('pending, approved, rejected');
            $table->string('final_status')->default('pending')->comment('pending, approved, rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
