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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->foreign('org_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('brand_name')->nullable();
            $table->boolean('use_brand_name')->default(false)->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable()->default('default.png');
            $table->string('status')->default('active')->comment('active, completed');
            $table->date('onboard_date')->nullable();
            $table->longText('point_of_contact')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
