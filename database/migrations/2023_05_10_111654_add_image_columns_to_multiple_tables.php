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
        Schema::table('users', function (Blueprint $table) {
            $table->string('image_title')->nullable();
            $table->string('image_alt')->nullable();
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->string('image_title')->nullable();
            $table->string('image_alt')->nullable();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('image_title')->nullable();
            $table->string('image_alt')->nullable();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('image_title')->nullable();
            $table->string('image_alt')->nullable();
        });

        Schema::table('about_us', function (Blueprint $table) {
            $table->string('image_title')->nullable();
            $table->string('image_alt')->nullable();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->string('image_title')->nullable();
            $table->string('image_alt')->nullable();
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->string('image_title')->nullable();
            $table->string('image_alt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
        });

        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
        });
    }
};
