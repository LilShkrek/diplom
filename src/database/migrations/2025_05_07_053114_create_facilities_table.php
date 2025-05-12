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
        Schema::create('facilities', function (Blueprint $table) {
            $table->comment('Оборудование');
            $table
                ->id()
                ->comment('Идентификатор');
            $table
                ->string('name')
                ->comment('Название оборудования');
            $table
                ->dateTimeTz('buy_date')
                ->comment('Дата покупки оборудования');
            $table
                ->dateTimeTz('operation_end_date')
                ->comment('Дата примерного окончания срока службы');
            $table
                ->integer('inventory_num')
                ->comment('Инвентарный номер');
            $table
                ->integer('employee_id')
                ->nullable()
                ->comment('Идентификатор пользователя');

            $table->foreign('employee_id')
                ->references('id')->on('employees')
                ->onDelete('cascade');

            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
