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
            if (!Schema::hasColumn('users', 'agn')) {
                $table->integer('agn')->nullable();
            }
            if (!Schema::hasColumn('users', 'brn')) {
                $table->integer('brn')->nullable();
            }
            if (!Schema::hasColumn('users', 'dpm')) {
                $table->integer('dpm')->nullable();
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'agn')) {
                $table->dropColumn('agn');
            }
            if (Schema::hasColumn('users', 'brn')) {
                $table->dropColumn('brn');
            }
            if (Schema::hasColumn('users', 'dpm')) {
                $table->dropColumn('dpm');
            }
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
