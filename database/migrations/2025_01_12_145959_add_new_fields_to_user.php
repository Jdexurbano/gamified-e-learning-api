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
            $table->string('username')->unique()->after('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_initial');
            $table->unsignedTinyInteger('age');
            $table->string('student_No');
            $table->string('address');
            $table->string('role');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('middle_initial');
            $table->dropColumn('age');
            $table->dropColumn('student_No');
            $table->dropColumn('address');
            $table->dropColumn('role');
        });
    }
};
