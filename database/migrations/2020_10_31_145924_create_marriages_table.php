<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marriages', function (Blueprint $table) {
            $table->id();
            $table->integer('church_id')->nullable()->unsigned();
            $table->string('other_church')->nullable();
            $table->UnsignedBiginteger('husband_id');
            $table->UnsignedBiginteger('wife_id');
            $table->string('wife_status');
            $table->string('wife_education');
            $table->string('husband_status');
            $table->string('husband_education');
            $table->date('date_of_seminar');
            $table->date('date_of_marriage');

            $table->integer('created_by')->nullable()->unsigned();
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('marriages');
    }
}
