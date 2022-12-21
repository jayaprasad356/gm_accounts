<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{

    protected $table='projects';

    protected  $primarykey ='project_id';
}
