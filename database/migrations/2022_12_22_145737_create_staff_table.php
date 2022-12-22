<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('mobile',20)->unique();
            $table->string('email',100)->nullable();
            $table->string('password',100);
            $table->string('work_type',100)->nullable();
            $table->string('salary_type',100)->nullable();
            $table->string('github',100)->nullable();
            $table->string('upi',100)->nullable();
            $table->string('holder_name',100)->nullable();
            $table->string('bank_name',100)->nullable();
            $table->string('account_number')->nullable();
            $table->string('branch',100)->nullable();
            $table->string('ifsc_code',100)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
