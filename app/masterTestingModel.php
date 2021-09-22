<?php

namespace App;

use DB;
use Auth;
use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class masterTestingModel extends Model
{
    use Uuids;
    public $timestamps      = false;
    public $incrementing    = false;
    protected $guarded      = ['id'];
    protected $dates        = ['created_at','updated_at','deleted_at'];
    protected $fillable     = ['detail_testing_id', 'testing_code', 'testing_name', 'master_method_id','detail_testing_1', 'detail_testing_2', 'keterangan', 'created_at', 'updated_at', 'deleted_at', 'created_by','deleted_by'];
    protected $table        = 'master_testing';
}
