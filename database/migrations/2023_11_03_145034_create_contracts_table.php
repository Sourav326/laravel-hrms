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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_reference');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->string('job_position');
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->string('salary_structure_type')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('working_schedule')->nullable();
            $table->string('work_entry_source')->nullable();
            $table->string('hr_responsible')->nullable();
            $table->longText('contract_details')->nullable();
            $table->string('salary');
            $table->enum('is_partTime', ['yes','no'])->nullable();
            $table->string('partTime_entry_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
