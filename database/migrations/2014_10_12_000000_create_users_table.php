<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->string('username')->nullable()->unique();
            $table->enum('type', User::USER_TYPES);
            $table->string('password');
            $table->string('activation_code')->nullable()->index();
            $table->string('persist_code')->nullable();
            $table->string('reset_password_code')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('permissions')->nullable();
            $table->boolean('consent')->default(0);
            $table->boolean('is_activated')->default(0);
            $table->boolean('email_notifications')->default(1);
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->boolean('is_guest')->default(false);
            $table->boolean('is_superuser')->default(false);
            $table->string('created_ip_address')->nullable();
            $table->string('last_ip_address')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
