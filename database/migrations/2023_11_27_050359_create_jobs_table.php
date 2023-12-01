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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->foreignId('user_id')->constrained();
            $table->string('designation');
            $table->integer('no_of_positions');
            $table->string('department');
            $table->string('expected_compensation');
            $table->string('requested_by');
            $table->string('requested_by_department')->nullable();
            $table->string('requested_by_designation')->nullable();
            $table->dateTime('posted_on');
            $table->dateTime('expected_by');
            $table->enum('publish_on_website', [0,1])->default(0);//0-no  1-yes
            $table->enum('status', [0,1,2,3])->default(1);//Deactive,Active,Pending,Complete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
