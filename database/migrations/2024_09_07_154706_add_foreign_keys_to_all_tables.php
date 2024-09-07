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
        Schema::table('all_tables', function (Blueprint $table) {
            
           
        Schema::table('locations', function (Blueprint $table) {
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            
        });

        Schema::table('assets', function (Blueprint $table) {
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
        });

        
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
        });

        
        Schema::table('managers', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
        });

        Schema::table('company_groups', function (Blueprint $table) {
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_head_id')->nullable()->constrained('employees')->onDelete('set null');
        });

      
        Schema::table('company_group_subgroups', function (Blueprint $table) {
            $table->foreignId('parent_group_id')->constrained('company_groups')->onDelete('cascade');
            $table->foreignId('child_group_id')->constrained('company_groups')->onDelete('cascade');
        });


     


      


       
       

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_tables', function (Blueprint $table) {
            
// Drop foreign keys from locations table
Schema::table('locations', function (Blueprint $table) {
    $table->dropForeign(['company_id']);
});

// Drop foreign keys from assets table
Schema::table('assets', function (Blueprint $table) {
    $table->dropForeign(['company_id']);
});

// Drop foreign keys from employees table
Schema::table('employees', function (Blueprint $table) {
    $table->dropForeign(['company_id']);
    $table->dropForeign(['person_id']);
});

// Drop foreign keys from managers table
Schema::table('managers', function (Blueprint $table) {
    $table->dropForeign(['employee_id']);
});

// Drop foreign keys from company groups table
Schema::table('company_groups', function (Blueprint $table) {
    $table->dropForeign(['company_id']);
    $table->dropForeign(['group_head_id']);
});

// Drop foreign keys from company group subgroups table
Schema::table('company_group_subgroups', function (Blueprint $table) {
    $table->dropForeign(['parent_group_id']);
    $table->dropForeign(['child_group_id']);
});

        });
    }
};
