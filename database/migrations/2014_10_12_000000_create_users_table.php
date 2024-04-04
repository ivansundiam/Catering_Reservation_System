<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number');
            $table->string('user_type')->default('client');
            $table->boolean('verified')->default(false);
            $table->string('id_verify_img');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '09876543211',
            'id_verify_img' => 'asdfasd',
            'user_type' => 'admin', 
            'password' => bcrypt('123456789'),
        ]);        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
