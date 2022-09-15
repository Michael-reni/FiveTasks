<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class nip implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $error_message;
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $nip)
    {
        if(!is_numeric($nip)){
            $this->error_message = 'nip must contain only digits: 0-9';
            return false;
        }
        if(strlen($nip)!=10)
        {
            $this->error_message = 'nip must be ten digits length';
            return false;
        }
        $sum = 0;
        $multiplers =array(6, 5, 7, 2, 3, 4, 5, 6, 7); 
        foreach ($multiplers as $key=>$multipler){

            $sum = $sum + ($multipler * $nip[$key] );
        }
        if($sum%11 != (int)$nip[9]){
            $this->error_message = 'sum control of nip is incorrect';
            return false;
        }


        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error_message;
    }
}
