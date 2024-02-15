<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IncomeStatisticTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lottery_winners_are_shown()
    {
        $response = $this->get('/api/incomeStatistic');
        
        $response->assertJson(['results' => [
                [
                    "nazwa loterii" => "GG World Million",
                    "przychód" => "41.96",
                    "zysk" => "31.47"
                ],
                [
                    "nazwa loterii" => "GG World X",
                    "przychód" => "64.95",
                    "zysk" => "25.98"
                ],
            ],
            "info" => "Jeśli chcesz podejrzeć SQL to zajrzyj do klasy TaskController.php funkcja incomeStatistic()."
        ]); 
       
        $response->assertStatus(200);
    }
}
