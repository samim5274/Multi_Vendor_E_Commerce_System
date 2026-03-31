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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->string('photo')->nullable();

            // Personal info
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->string('national_id', 50)->nullable();
            $table->string('religion', 50)->nullable();

            // Role & type
            $table->enum('role', ['super_admin', 'admin', 'vendor_owner', 'vendor_staff', 'customer'])->default('customer');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('cascade');

            $table->boolean('is_active')->default(true);
            $table->boolean('is_profile_completed')->default(false);

            // Addresses
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();

            // Verification
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('otp', 10)->nullable();
            $table->timestamp('otp_expires_at')->nullable();

            // Login info
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->rememberToken();

             // Wallet / credits for customers or vendor users
            $table->decimal('wallet_balance', 12, 2)->default(0); // for refunds, credits, etc.

            // Security / tokens
            $table->string('tokens', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
