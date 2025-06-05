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
            $table->comment('Сотрудники');
            $table
                ->id()
                ->comment('Идентификатор');
            $table
                ->string('name')
                ->comment('Имя');
            $table
                ->string('surname')
                ->comment('Фамилия');
            $table
                ->string('patronymic')
                ->comment('Отчество');
            $table
                ->string('position')
                ->comment('Должность');
            $table
                ->integer('service_number')
                ->comment('Табельный номер');
            $table->timestamps(6);
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
