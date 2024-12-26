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
        Schema::create('monthly_reports', function (Blueprint $table) {
            $table->id();
            $table->string('sr_number')->nullable();
            $table->date('receiving_date')->nullable();
            $table->string('truck')->nullable();
            $table->string('driver')->nullable();
            $table->string('manifest')->nullable();
            $table->string('unit')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('minimum_weight')->nullable();
            $table->float('maximum_weight')->nullable();
            $table->float('average_weight')->nullable();
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->string('waste_type')->nullable();
            $table->string('location')->nullable();
            $table->string('client')->nullable();
            $table->string('dumping')->nullable();
            $table->string('unit_price')->nullable();
            $table->decimal('other_charges', 8, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('column1')->nullable();
            $table->string('car_number')->nullable();
            $table->string('type_of_materials')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('properties_code')->nullable();
            $table->string('transporter_ticket_number')->nullable();
            $table->string('disp_ticket_number')->nullable();
            $table->string('disposal_method')->nullable();
            $table->string('treatment_method')->nullable();
            $table->string('disposal_treatment')->nullable();
            $table->dateTime('date_load')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_reports');
    }
};
