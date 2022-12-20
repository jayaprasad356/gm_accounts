<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Client extends Authenticatable
{
    use Notifiable;

    protected $table='clients';

    protected  $primarykey ='client_id';
}
