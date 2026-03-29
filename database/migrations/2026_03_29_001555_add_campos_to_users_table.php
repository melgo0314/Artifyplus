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
        Schema::table('users', function (Blueprint $table) {
            //
            $table ->string('role')->default(false)->after('password');
            $table->string('subscription_status')->default('false')->after('role');
            $table->timestamp('subscription_start')->nullable()->after('subscription_status');
            $table->timestamp('subscription_end')->nullable()->after('subscription_start');
            $table->boolean('is_active')->default(true)->after('subscription_end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
              $table->dropColumn([
                'role',
                'subscription_status',
                'subscription_start',
                'subscription_end',
                'is_active'
            ]);
        });
    }
};
