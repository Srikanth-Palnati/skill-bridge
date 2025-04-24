<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseEnrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enroll', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users');  // Foreign Key Constraint 
            $table->biginteger('course_id'); 
            $table->foreign('course_id')->references('id')->on('courses'); // Foreign Key Constraint 
            $table->decimal('price');
            $table->string('certificate')->nullable();
            $table->string('status')->nullable()->default('InProgress');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_enroll');
    }
}
