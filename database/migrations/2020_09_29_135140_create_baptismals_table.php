<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaptismalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baptismals', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('place_of_birth');

            $table->string('fathers_name');
            $table->string('mothers_maiden_name');
            $table->string('parents_address');
            $table->string('contact_number');
            $table->string('parents_type_of_marriage');

            $table->integer('church_id')->unsigned();
            $table->date('date_of_attending_seminar');
            $table->string('date_of_baptismal');

            $table->integer('created_by')->nullable()->unsigned();
            $table->boolean('is_deleted')->nullable();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamp('deleted_at')->nullable();

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
        Schema::dropIfExists('baptismals');
    }
}
