<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTask3 extends Model
{
    use HasFactory;

    protected $fillable = ['firm_name','email','password','NIP'];
    
    protected $table =  'companies_table_task_3';

}
