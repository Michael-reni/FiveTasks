<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('lotteries', function (Blueprint $table) {
            
            $table->id(); 
            $table->string('name', 255)->notNull();
            $table->decimal('ticket_price', 12, 2)->notNull();
            $table->decimal('prize', 12, 2 )->notNull();
        });

        DB::table('lotteries')->insert([
            ['name' => 'GG World Million', 'ticket_price' => 10.49, 'prize' => 300.00],
            ['name' => 'GG World X', 'ticket_price' => 12.99, 'prize' => 400.00]
        ]);

        
        Schema::create('draws', function (Blueprint $table) {
            
            $table->id(); 
            $table->unsignedBigInteger('lottery_id')->notNull();
            $table->foreign('lottery_id')->references('id')->on('lotteries')->onDelete('cascade');
            $table->timestamp('draw_date')->notNull();
            $table->integer('won_number')->nullable();
        });


        DB::table('draws')->insert([
            ['id' => 1, 'lottery_id' => 1, 'draw_date' => '2021-06-15 14:00:00', 'won_number' => 32],
            ['id' => 2, 'lottery_id' => 1, 'draw_date' => '2021-07-15 14:00:00', 'won_number' => 47],
            ['id' => 3, 'lottery_id' => 1, 'draw_date' => '2021-08-15 14:00:00', 'won_number' => 5],
            ['id' => 4, 'lottery_id' => 1, 'draw_date' => '2021-09-15 14:00:00', 'won_number' => null],
            ['id' => 5, 'lottery_id' => 2, 'draw_date' => '2021-07-01 16:00:00', 'won_number' => 29],
            ['id' => 6, 'lottery_id' => 2, 'draw_date' => '2021-08-01 16:00:00', 'won_number' => 4],
            ['id' => 7, 'lottery_id' => 2, 'draw_date' => '2021-09-01 16:00:00', 'won_number' => null]
        ]);


        Schema::create('tickets', function (Blueprint $table) {
            
            $table->id(); 
            $table->unsignedBigInteger('draw_id')->notNull();;
            $table->foreign('draw_id')->references('id')->on('draws')->onDelete('cascade');
            $table->timestamp('bought_date')->notNull();
            $table->integer('number')->notNull();
        });


        DB::table('tickets')->insert([
            [ 'draw_id' => 1, 'bought_date' => '2021-05-16 18:21:34', 'number' => 21 ],
            [ 'draw_id' => 1, 'bought_date' => '2021-06-02 13:31:02', 'number' => 29 ],
            [ 'draw_id' => 1, 'bought_date' => '2021-06-15 14:00:02', 'number' => 13 ],
            [ 'draw_id' => 2, 'bought_date' => '2021-06-30 03:44:34', 'number' => 47 ],
            [ 'draw_id' => 2, 'bought_date' => '2021-07-02 07:09:02', 'number' => 32 ],
            [ 'draw_id' => 2, 'bought_date' => '2021-07-15 14:00:15', 'number' => 5 ],
            [ 'draw_id' => 3, 'bought_date' => '2021-07-15 15:44:34', 'number' => 13 ],
            [ 'draw_id' => 3, 'bought_date' => '2021-07-28 04:29:11', 'number' => 5 ],
            [ 'draw_id' => 3, 'bought_date' => '2021-08-15 13:59:58', 'number' => 5 ],
            [ 'draw_id' => 3, 'bought_date' => '2021-08-15 14:00:01', 'number' => 5 ],
            [ 'draw_id' => 4, 'bought_date' => '2021-08-25 01:15:48', 'number' => 38 ],
            [ 'draw_id' => 5, 'bought_date' => '2021-06-04 22:01:53', 'number' => 29 ],
            [ 'draw_id' => 5, 'bought_date' => '2021-06-24 05:25:09', 'number' => 13 ],
            [ 'draw_id' => 5, 'bought_date' => '2021-07-01 16:00:05', 'number' => 29 ],
            [ 'draw_id' => 5, 'bought_date' => '2021-07-01 16:00:02', 'number' => 24 ],
            [ 'draw_id' => 5, 'bought_date' => '2021-07-01 16:00:03', 'number' => 11 ],
            [ 'draw_id' => 6, 'bought_date' => '2021-07-24 04:32:56', 'number' => 4 ],
            [ 'draw_id' => 6, 'bought_date' => '2021-08-01 16:02:01', 'number' => 13 ],
            [ 'draw_id' => 7, 'bought_date' => '2021-07-16 22:34:49', 'number' => 36 ],
            [ 'draw_id' => 7, 'bought_date' => '2021-08-04 16:00:55', 'number' => 15 ],
            [ 'draw_id' => 7, 'bought_date' => '2021-08-04 16:00:55', 'number' => 49 ],
            [ 'draw_id' => 7, 'bought_date' => '2021-08-04 16:00:55', 'number' => 46 ],
        ]);
 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('draws');
        Schema::dropIfExists('lotteries');       
    }
};
