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
        Schema::create('instagram_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();  
            $table->string('full_name')->nullable();  
            $table->string('profile_picture')->nullable();  
            $table->text('bio')->nullable();  
            $table->string('website')->nullable();  
            $table->integer('followers_count')->default(0);  
            $table->integer('following_count')->default(0);   
            $table->integer('posts_count')->default(0);
            $table->string('location')->nullable(); 
            $table->text('hashtags')->nullable();  
            $table->text('description')->nullable();
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
        Schema::dropIfExists('instagram_accounts');
    }
};
