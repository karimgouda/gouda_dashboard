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
        Schema::create('seotools', function (Blueprint $table) {
            $table->id();

            // Open Graph Columns
            $table->string('og_type')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_url')->nullable();
            $table->text('og_image')->nullable();
            $table->string('og_description')->nullable();

            // Twitter Card Columns
            $table->text('twitter_card')->nullable();
            $table->string('twitter_title')->nullable();
            $table->string('twitter_site')->nullable();
            $table->text('twitter_description')->nullable();
            $table->text('twitter_image')->nullable();
            $table->text('twitter_image_alt')->nullable();

            // Polymorphic
            $table->integer('seoable_id')->nullable();
            $table->string('seoable_type')->nullable();

            // Setting Flag
            $table->boolean('is_for_setting')->default(false);

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
        Schema::dropIfExists('seotools');
    }
};
