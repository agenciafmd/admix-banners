<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')
                ->unsigned()
                ->index()
                ->default(1);
            $table->boolean('star')
                ->unsigned()
                ->index()
                ->default(0);
            $table->string('name');
            $table->json('meta')
                ->nullable();
            $table->string('link', 150)
                ->nullable();
            $table->string('target', 30)
                ->nullable();
            $table->dateTime('published_at');
            $table->dateTime('until_then')
                ->nullable();
            $table->string('slug')
                ->unique()
                ->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
