<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EncryptMessageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lottery_winners_are_shown()
    {

        // $originalMessage = "Zażółć, gęślą jaźń.";
        
        // $response = $this->post('/api/encryptMessage', ['message' => $originalMessage]);
        //  // //nie przekazują się dane do reauest body czemu... tak jaggby $data była pusta
        // $response->assertStatus(200);
        // $encryptedMessage = $response->getContent();
        // print_r($encryptedMessage);
        // $response = $this->post('/api/decryptMessage', ['message' => $encryptedMessage]);
        
        // $decryptMessage = $response->getContent();
        
        // $response->assertStatus(200);
    }
}