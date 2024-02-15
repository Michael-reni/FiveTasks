<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LotteryWinnersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lottery_winners_are_shown()
    {
        $response = $this->get('/api/lotteryWinners');
        
        $response->assertJson(['results' => [
                [
                    "id" => 12,
                ],
                [
                    "id" => 14,
                ],
                [
                    "id" => 17,
                ],

            ],
            "info" => "Jeśli chcesz podejrzeć SQL to zajrzyj do klasy TaskController.php funkcja lotteryWinners()."
        ]); 

    
        $response->assertStatus(200);
    }
}
