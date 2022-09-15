<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UserTask3;
use App\Models\CompanyTask3;
use App\Rules\nip;

use Carbon\Carbon;

class TaskController extends Controller
{
   
/**
     * @OA\Get(
     *      path="/task1/{year}/{month}",
     *      tags={"tasks"},

     *      summary="view calendar",
     *     
     *      @OA\Parameter(
     *          name="year",
     *          description="Calendar year from 1 to 9999",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="2022"
     *          )
     *      ),
     * 
     *        @OA\Parameter(
     *          name="month",
     *          description="Calendar month. Please use english langauge",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              example="September"
     *          )
     *      ),
     * 
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *      @OA\JsonContent(),
     *          
     *       ),
     *        @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     * 
  
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *     
     *     )
     */
    public function task_1_calendar(Request $request,$year,$month){
    
        $validator = Validator::make(['year' => $year,'month' => $month], [ 
            'year' => ['required','integer','min:1','max:9999'],
            'month'=> ['required','in:January,February,March,April,May,June,July,August,September,October,November,December'] 
        ],);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $year = $validator->validated()['year'];
        $month = $validator->validated()['month'];
        $date = new Carbon("1" . "$month" . "$year");  

        $first_day = $date->format('l');
        $last_day = $date->endOfMonth()->format('l');

        $Monday = 0;
        $Tuesday = 1;
        $Wednesday = 2;
        $Thursday = 3;
        $Friday = 4;
        $Saturday = 5;
        $Sunday = 6;
       
        $cells_in_grid = $date->daysInMonth + $$first_day + ( 6 - $$last_day);

        $grid = array();
        $i = 0;
        $day_number = 0;
       
        while( $cells_in_grid ){
            if( $i >= $$first_day && $i <= $date->daysInMonth + $$first_day ){
                $day_number++;
            }
            if($i >= $date->daysInMonth + $$first_day ){
                $grid[$i] = 0;
            }else{
                $grid[$i] = $day_number;
            }
            
            $i++;
            $cells_in_grid--;
        }

        foreach($grid as $key => $g){
            if($grid[$key] == 0){
                $grid[$key] = '';
            }
        }
    

        return view('task_1_calendar', 
        [         
            'grid' => $grid,
            'year' => $year,
            'month' => $month
        ]);
    }


/**
     * @OA\Get(
     *      path="/task2/{excell_string}",
     *      tags={"tasks"},

     *      summary="Change Excell cell string fromat to numeric format",
     *     
     *      @OA\Parameter(
     *          name="excell_string",
     *          description="Excell string that represt cell",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              example="A2"
     *          )
     *      ),
     * 
     * 
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *      @OA\JsonContent(),
     *          
     *       ),
     *        @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     * 
  
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *     
     *     )
     */
    public function task2(Request $request,$excell_string){
         
        $validator = Validator::make(['excell_string' => $excell_string], [ // Validating if string is in format "LettersNumbers"
            'excell_string' => ['required','regex:/^[A-Z]+[\d]+$/'] // it uses preg_match under the hood
        ],[
            'excell_string' =>"this string is not valid for this task. Valid examples: 'A2', 'BB34'"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $excell_string = $validator->validated()['excell_string'];
                                                       
        preg_match('/[A-Z]+/', $excell_string, $chars);  // Taking part of string that contains letters, i asumed that  there can be more than one letter exp: "AA20" this is still valid cell in excel
        $chars = $chars[0];
                                       
        $ASCII =  unpack("C*",$chars);  // Changing those letters into array of ASCII code. each code represt one letter 

        $firstString= "";
        foreach ($ASCII as $char){
            $firstString =  $firstString . (string)($char - 64);  // concating string with modified ASCII number so it coud match task requirement  
        }
      
       preg_match('/\d+/',  $excell_string,$secondString); 
       $second_string = $secondString[0]; // Taking second part of string that contains numbers
       $final_string = $firstString.'.'.$second_string; // Concating the answaer
       return response()->json( $final_string, 200);  // returning postivie response with data
     
    }

    /**  @OA\Post(
        *      path="/task3/user",
        *      
        *      tags={"tasks"},
        *      summary="Store new project",
        *      description="create User for task 3",
        *        @OA\RequestBody(     
        *           required=true,
        *           description="pass data to create user record",
        *        
        *      @OA\JsonContent(
        *           @OA\Property(property = "name", type="string", example="Jan", description = "user name"),
        *           @OA\Property(property = "email", type="string", example="jankowalski@wp.pl", description = "user email"),
        *           @OA\Property(property = "password", type="string", example="strongpassword123", description = "user password"),
        *           @OA\Property(property = "date_of_birth", type="date", example="20-05-2000", description = "user date of birth"),
 
        *      ),),
        *      @OA\Response(
        *          response=201,
        *          description="Created",
         *    @OA\JsonContent(
         * ),
        *       ),
        *        @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     * 
  
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
        * )
        */
    public function task3_user(Request $request){

        $request = $request->validate([      
            'name' => 'required|string',
            'email' => 'required|email|unique:users_table_task_3',
            'password' => 'required|min:9',
            'date_of_birth' => 'required|date_format:d-m-Y'
        ]);
       
        try{
            $user = UserTask3::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'date_of_birth' =>$request['date_of_birth'],
            ]);

            return response()->json([ 
                'message' => 'User successfully crated',    
            ],201);
        }
        catch(\Exception $exception){     
            return response()->json($exception->getMessage(),500);
        }
    }

     /**  @OA\Post(
        *      path="/task3/company",
        *      
        *      tags={"tasks"},
        *      summary="Store new project",
        *      description="create Company for task 3",
        *        @OA\RequestBody(     
        *           required=true,
        *           description="pass data to create company record",
        *        
        *      @OA\JsonContent(
        *           @OA\Property(property = "firm_name", type="string", example="Fake Company", description = "Company name"),
        *           @OA\Property(property = "email", type="string", example="jankowalski@wp.pl", description = "Company email"),
        *           @OA\Property(property = "password", type="string", example="strongpassword123", description = "Company password"),
        *           @OA\Property(property = "NIP", type="string", example="6074526612", description = "Company NIP"),
 
        *      ),),
        *      @OA\Response(
        *          response=201,
        *          description="Created",
         *    @OA\JsonContent(
         * ),
        *       ),
        *        @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     * 
  
     *       @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
        * )
        */

    public function task3_company(Request $request){

        $validated = $request->validate([      
            'firm_name' => 'required|string',
            'email' => 'required|email|unique:companies_table_task_3',
            'password' => 'required|min:9',
            //'NIP' => 'required|string',
            'NIP' => ['required','string', new nip,'unique:companies_table_task_3'],
        ]);

        try{
            $user = CompanyTask3::create([
                'firm_name' => $request['firm_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'NIP' =>$request['NIP'],
            ]);

            return response()->json([ 
                'message' => 'Company successfully crated',    
            ],201);
        }
        catch(\Exception $exception){     
            return response()->json($exception->getMessage(),500);
        }     
    }


   
  

}



