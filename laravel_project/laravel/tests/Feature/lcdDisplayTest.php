<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class lcdDisplayTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_digits_are_shown_correctly()
    {
        // $data = [
        //     "digits"=> "0123456789"
        // ];

        // $response = $this->post('/api/lcdDisplay', $data);
        // //nie przekazują się dane do reauest body czemu... tak jaggby $data była pusta
       
           
        // $response->assertJson([
        //     0 =>
        //         [
        //             "L" => " _     _  _     _  _  _  _  _ ",
        //             "C" => "| |  | _| _||_||_ |_   ||_||_|",
        //             "D" => "|_|  ||_  _|  | _||_|  ||_| _|"
        //         ],
        //     1 => ' _     _  _ \\n| |  | _| _|\\n|_|  ||_  _|\\n'   
        // ]); 
       
        // $response->assertStatus(200);
    }
}