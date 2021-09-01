<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('salary');
            $table->integer('days_norm');
            $table->integer('worked_days');
            $table->boolean('is_tax_deduction');
            $table->integer('calendar_year');
            $table->integer('calendar_month');
            $table->boolean('is_pensioner');
            $table->boolean('is_disabled');
            $table->integer('disabled_group')->nullable();
            $table->integer('osms_tax');
            $table->integer('vosms_tax');
            $table->integer('opv_tax');
            $table->integer('ipn_tax');
            $table->integer('so_tax');
            $table->integer('hand_salary');
            $table->integer('credited_salary');
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
        Schema::dropIfExists('salaries');
    }
}
