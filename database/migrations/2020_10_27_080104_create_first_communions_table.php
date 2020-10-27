<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstCommunionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_communions', function (Blueprint $table) {
            $table->id();
            $table->integer('church_id')->nullable()->unsigned();
            $table->string('other_church')->nullable();
            $table->UnsignedBiginteger('baptismal_id');
            $table->date('date_of_communion');

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
        Schema::dropIfExists('first_communions');
    }
}
