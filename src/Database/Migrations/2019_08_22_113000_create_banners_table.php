<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')
                ->default(1);
            $table->boolean('star')
                ->default(0);
            $table->string('location', 150);
            $table->string('name');
            $table->text('description')
                ->nullable();
            $table->string('link', 150)
                ->nullable();
            $table->string('target', 30)
                ->nullable();
            $table->dateTime('published_at');
            $table->dateTime('until_then')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
}
