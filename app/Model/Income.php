<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Income extends Model
{

    protected $table='incomes';

    protected  $primarykey ='project_id';
}
