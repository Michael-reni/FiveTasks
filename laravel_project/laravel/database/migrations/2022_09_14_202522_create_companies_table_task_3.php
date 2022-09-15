<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_table_task_3', function (Blueprint $table) {
            $table->id(); 
            $table->string('firm_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('NIP')->unique();
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
        Schema::dropIfExists('companies_table_task_3');
    }
};
