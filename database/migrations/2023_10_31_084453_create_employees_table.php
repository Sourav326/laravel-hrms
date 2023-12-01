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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('created_by');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('emergency_mobile');
            $table->string('permanent_address');
            $table->string('temporary_address');
            $table->string('nationality');
            $table->enum('marital_status', ['single','married']);
            $table->tinyText('blood_type');
            $table->enum('gender', ['male','female','other']);
            $table->date('dob');
            $table->string('birth_place');
            $table->string('job_position');
            $table->string('manager');
            $table->string('work_email');
            $table->string('time_off_approver')->nullable();
            $table->string('timesheet_approver')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('timezone')->nullable();
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('account_holder_name');
            $table->string('account_type');
            $table->string('account_nmber');
            $table->string('ifsc');
            $table->string('employee_code');
            $table->string('pay_period')->nullable();
            $table->string('pay_rate')->nullable();
            $table->string('pay_type')->nullable();
            $table->string('hours_worked')->nullable();
            $table->string('overtime_hours')->nullable();
            $table->string('overtime_pay_rate')->nullable();
            $table->enum('overtime_pay', ['yes','no']);
            $table->enum('deductions', ['yes','no']);
            $table->enum('federal_income_tax', ['yes','no'])->nullable();
            $table->enum('state_income_tax', ['yes','no'])->nullable();
            $table->enum('local_income_tax', ['yes','no'])->nullable();
            $table->enum('social_security', ['yes','no'])->nullable();
            $table->enum('medicare', ['yes','no'])->nullable();
            $table->enum('retirement_contribution', ['yes','no'])->nullable();
            $table->enum('health_insurance_premium', ['yes','no'])->nullable();
            $table->string('net_pay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
