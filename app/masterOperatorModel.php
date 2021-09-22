<?php

namespace App;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class masterOperatorModel extends Model
{
    public $timestamps      = false;
    // public $incrementing    = false;
    protected $guarded      = ['id'];
    protected $dates        = ['created_at','updated_at'];
    protected $fillable     = ['operator_name' , 'created_at', 'updated_at'];
    protected $table        = 'master_operators';
}
