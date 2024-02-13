<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
   
    /**
     * @OA\Post(
     *      path="/decryptMessage/{message}",
     *      tags={"tasks"},

     *      summary="Decrypt message.",
     *     
     *      @OA\Parameter(
     *          name="message",
     *          description="Message to decrypt.",
     *          in="path",
     *          @OA\Schema(
     *              type="String",
     *              example="(o>!a!"
     *          )
     *      ),
     * 
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(), 
     *       ),
     * 
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     * 
     *     )
     */
    public function decryptMessage(Request $request, String $message) {
      
        $dictionary = [
            '!' => 'a', 'c' => 'n', 
            ')' => 'b', 'd' => 'o', 
            '"' => 'c', 'e' => 'p', 
            '(' => 'd', 'f' => 'q', 
            '£' => 'e', 'g' => 'r',  
            '*' => 'f', 'h' => 's', 
            '%' => 'g', 'i' => 't',     
            '&' => 'h', 'j' => 'u', 
            '>' => 'i', 'k' => 'v', 
            '<' => 'j', 'l' => 'w', 
            '@' => 'k', 'm' => 'x', 
            'a' => 'l', 'n' => 'y', 
            'b' => 'm', 'o' => 'z',                          
        ];
      
        $decryptedMessage = '';
        
        for ($i = 0; $i < strlen($message); $i++) {
            
            // może coś lepszego wymyślisz
            if (ord($message[$i]) == ord('£')) {
                $i++;
                $decryptedMessage .= $dictionary['£'];
              
            } else {
                $decryptedMessage .= $dictionary[$message[$i]] ?? $message[$i];
            }
        }

        return response()->json($decryptedMessage, 200, [], JSON_UNESCAPED_UNICODE);
    }


    /**
     * @OA\Post(
     *      path="/encryptMessage/{message}",
     *      tags={"tasks"},

     *      summary="Encrypt message.",
     *     
     *      @OA\Parameter(
     *          name="encryptedMessage",
     *          description="Message to encrypt.",
     *          in="path",
     *          @OA\Schema(
     *              type="String",
     *              example="dziala"
     *          )
     *      ),
     * 
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(), 
     *       ),
     * 
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     * 
     *     )
     */
    public function encryptMessage(Request $request, String $message) {
        
        $dictionary = [
            '!' => 'a', 'c' => 'n', 
            ')' => 'b', 'd' => 'o', 
            '"' => 'c', 'e' => 'p', 
            '(' => 'd', 'f' => 'q', 
            '£' => 'e', 'g' => 'r',  
            '*' => 'f', 'h' => 's', 
            '%' => 'g', 'i' => 't', 
            '&' => 'h', 'j' => 'u', 
            '>' => 'i', 'k' => 'v', 
            '<' => 'j', 'l' => 'w', 
            '@' => 'k', 'm' => 'x', 
            'a' => 'l', 'n' => 'y', 
            'b' => 'm', 'o' => 'z',                          
        ];

        $dictionary = array_flip($dictionary);
      
        $encryptedMessage = '';
        for ($i = 0; $i < strlen($message); $i++) {
            $encryptedMessage .= $dictionary[$message[$i]] ?? $message[$i];
        }

        return response()->json($encryptedMessage, 200, [], JSON_UNESCAPED_UNICODE);
    }



     /**
     * @OA\Post(
     *      path="/lcdDisplay/{digits}",
     *      tags={"tasks"},
     *      summary="Digits",
     *     
     *      @OA\Parameter(
     *          name="digits",
     *          description="Digits to display",
     *          in="path",
     *          @OA\Schema(
     *              type="String",
     *              example="0123"
     *          )
     *      ),
     * 
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(), 
     *       ),
     * 
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     * 
     *     )
     */
    public function lcdDisplay(Request $request, String $digits) {
        
        // zrobić z tego inny exception
        if (preg_match('/[^0-9]/', $digits)) {
            throw new Exception('Można podawać tylko cyfry od 0-9.');
        } 

        $firstLine = [
            '0' => ' _ ',
            '1' => '   ',
            '2' => ' _ ',
            '3' => ' _ ',
            '4' => ' _ ',
            '5' => ' _ ',
            '6' => ' _ ',
            '7' => ' _ ',
            '8' => ' _ ',
            '9' => ' _ ',             
        ];

        $secondLine = [
            '0' => '| |',
            '1' => '  |',
            '2' => ' _|',
            '3' => ' _|',
            '4' => '|_|',
            '5' => '|_ ',
            '6' => '|_ ',
            '7' => '  |',
            '8' => '|_|',
            '9' => '|_|',             
        ];
        
        $thirdLine = [
            '0' => '|_|',
            '1' => '  |',
            '2' => '|_ ',
            '3' => ' _|',
            '4' => '  |',
            '5' => ' _|',
            '6' => '|_|',
            '7' => '  |',
            '8' => '|_|',
            '9' => ' _|',             
        ];
        
        
      // propozycja 1 
        $displayableDigitsText = '';
        
        $displayableDigitsJson =  [
            'L' => '',
            'C' => '',
            'D' => '',
        ];
         
        for ($i = 0; $i < strlen($digits); $i++) {
            $displayableDigitsText .= $firstLine[$digits[$i]];
            $displayableDigitsJson['L'] .= $firstLine[$digits[$i]];
        }
        $displayableDigitsText .= '\n';

        for ($i = 0; $i < strlen($digits); $i++) {
            $displayableDigitsText .= $secondLine[$digits[$i]];
            $displayableDigitsJson['C'] .= $secondLine[$digits[$i]];
        }
        $displayableDigitsText .= '\n';


        for ($i = 0; $i < strlen($digits); $i++) {
            $displayableDigitsText .= $thirdLine[$digits[$i]];
            $displayableDigitsJson['D'] .= $thirdLine[$digits[$i]];
        }
        $displayableDigitsText .= '\n';

        // zrobić refaktor kodu potem 
        return response()->json([$displayableDigitsJson, $displayableDigitsText], 200);
    }


    /**
     * @OA\Get(
     *      path="/lotteryWinners",
     *      tags={"tasks"},
     *      summary="Wygrane losy",
     *     
     * 
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(), 
     *       ),
     * 
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     * 
     *     )
     */
    public function lotteryWinners(Request $request) {
        
        // $query = "SELECT * FROM tickets 
        // INNER JOIN draws ON tickets.draw_id = draws.id
        // INNER JOIN lotteries ON lotteries.id = draws.lottery_id
        // where tickets.number = draws.won_number 
        //   AND lotteries.name = 'GG World X'";
           
        // Better approach in my opinion
        $query = "SELECT tickets.id FROM tickets 
            INNER join draws ON tickets.draw_id = draws.id
            WHERE tickets.number = draws.won_number 
                AND draws.lottery_id = (SELECT lotteries.id 
                                        FROM lotteries  
                                        WHERE lotteries.name = 'GG World X' LIMIT 1)";

        // 12
        // 14
        // 17
        $results = DB::select($query);

        return response()->json(['results' => $results, "info" => "Jeśli chcesz podejrzeć SQL to zajrzyj do klasy TaskController.php funkcja lotteryWinners()."], 200);
    }


    /**
     * @OA\Get(
     *      path="/incomeStatistic",
     *      tags={"tasks"},
     *      summary="Statystyka zarobków",
     *     
     * 
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(), 
     *       ),
     * 
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     * 
     *     )
     */
    public function incomeStatistic(Request $request) {
        
        
        $handWriteSql = "select income.name as \"nazwa loterii\", income.income as przychód, (income.income - refunds.refunds) as zysk FROM 

        (select lotteries.name, sum(lotteries.ticket_price) as refunds from tickets 
        inner join draws on tickets.draw_id = draws.id
        inner join lotteries on lotteries.id = draws.lottery_id
            WHERE tickets.bought_date > draws.draw_date
                AND EXTRACT(MONTH FROM tickets.bought_date) = 7 
            Group By lotteries.name) as refunds
    
    Inner Join
    
        (select lotteries.name, sum(lotteries.ticket_price) as income from tickets 
        inner join draws on tickets.draw_id = draws.id
        inner join lotteries on lotteries.id = draws.lottery_id
                AND EXTRACT(MONTH FROM tickets.bought_date) = 7 
            Group By lotteries.name) as income
        
        on income.name =  refunds.name ";



        $beautySql = "SELECT
        income.name AS \"nazwa loterii\",
        income.income AS \"przychód\",
        (income.income - refunds.refunds) AS \"zysk\"
    FROM
        (SELECT
            lotteries.name,
            SUM(lotteries.ticket_price) AS refunds
        FROM
            tickets
            INNER JOIN draws ON tickets.draw_id = draws.id
            INNER JOIN lotteries ON lotteries.id = draws.lottery_id
        WHERE
            tickets.bought_date > draws.draw_date
            AND EXTRACT(MONTH FROM tickets.bought_date) = 7
        GROUP BY
            lotteries.name) AS refunds
    INNER JOIN
        (SELECT
            lotteries.name,
            SUM(lotteries.ticket_price) AS income
        FROM
            tickets
            INNER JOIN draws ON tickets.draw_id = draws.id
            INNER JOIN lotteries ON lotteries.id = draws.lottery_id
        WHERE
            EXTRACT(MONTH FROM tickets.bought_date) = 7
        GROUP BY
            lotteries.name) AS income
    ON
        income.name = refunds.name;";


        // "GG World Million"	41.96	31.47
        // "GG World X"	        64.95	25.98

        $results = DB::select($beautySql);

        return response()->json(['results' => $results, "info" => "Jeśli chcesz podejrzeć SQL to zajrzyj do klasy TaskController.php funkcja incomeStatistic()."], 200);
       
    }

}



