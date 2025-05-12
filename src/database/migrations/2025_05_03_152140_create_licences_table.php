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
        Schema::create('licences', function (Blueprint $table) {
            $table->comment('Лицензии');
            $table
                ->id()
                ->comment('Идентификатор');
            $table
                ->string('name', 200)
                ->comment('Название лицензии');
            $table
                ->dateTimeTz('buy_date')
                ->comment('Дата покупки лицензии');
            $table
                ->dateTimeTz('start_date')
                ->comment('Дата начала срока лицензии');
            $table
                ->dateTimeTz('end_date')
                ->comment('Дата окончания срока лицензии');
            $table
                ->string('key', 200)
                ->comment('Ключ лицензии');
            $table
                ->integer('facility_id')
                ->nullable()
                ->comment('Идентификатор оборудования');

            $table->timestamps(6);

            $table->foreign('facility_id')
                ->references('id')->on('facilities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licences');
    }
};
