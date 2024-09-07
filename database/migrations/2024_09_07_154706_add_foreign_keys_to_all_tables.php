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
        // Add foreign keys to the locations table
        Schema::table('locations', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
        });

        // Add foreign keys to the assets table
        Schema::table('assets', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
        });

        // Add foreign keys to the employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->nullable()->constrained('people')->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('cascade');
        });

        // Add foreign keys to the managers table
        Schema::table('managers', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->constrained()->onDelete('cascade');
        });

        // Add foreign keys to the company_groups table
        Schema::table('company_groups', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('group_head_id')->nullable()->constrained('employees')->onDelete('set null');
        });

        // Add foreign keys to the company_group_subgroups table
        Schema::table('company_group_subgroups', function (Blueprint $table) {
            $table->foreignId('parent_group_id')->constrained('company_groups')->onDelete('cascade');
            $table->foreignId('child_group_id')->constrained('company_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys from the locations table
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });

        // Drop foreign keys from the assets table
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });

        // Drop foreign keys from the employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['person_id']);
            $table->dropForeign(['location_id']);
        });

        // Drop foreign keys from the managers table
        Schema::table('managers', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });

        // Drop foreign keys from the company_groups table
        Schema::table('company_groups', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['group_head_id']);
        });

        // Drop foreign keys from the company_group_subgroups table
        Schema::table('company_group_subgroups', function (Blueprint $table) {
            $table->dropForeign(['parent_group_id']);
            $table->dropForeign(['child_group_id']);
        });
    }
};
