<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $table='staffs';

    protected  $primarykey ='staff_id';
}
