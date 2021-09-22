<?php

namespace App;

use DB;
use Auth;
use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class masterMethodModel extends Model
{
    use Uuids;
    public $timestamps      = false;
    public $incrementing    = false;
    protected $guarded      = ['id'];
    protected $dates        = ['created_at','updated_at','deleted_at'];
    protected $fillable     = ['method_code' , 'method_name', 'category', 'created_at', 'updated_at', 'deleted_at', 'created_by'];
    protected $table        = 'master_method';
}
