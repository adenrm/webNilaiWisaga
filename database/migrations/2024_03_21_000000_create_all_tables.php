<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create admins table
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender', ['L', 'P']);
            
            // Check if the 'status' column already exists before adding it
            if (!Schema::hasColumn('admins', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active');
            }
            
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Create studys table
        Schema::create('studys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        // 3. Create admin_study table
        Schema::create('admin_study', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->foreignId('study_id')->constrained('studys')->onDelete('cascade');
            $table->string('study_name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Drop tables in reverse order
        Schema::dropIfExists('admin_study');
        Schema::dropIfExists('studys');
        Schema::dropIfExists('admins');
    }
};