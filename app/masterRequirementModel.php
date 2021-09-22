<?php

namespace App;

use DB;
use Auth;
use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class masterRequirementModel extends Model
{
    use Uuids;
    public $timestamps      = false;
    public $incrementing    = false;
    protected $guarded      = ['id'];
    protected $dates        = ['created_at','updated_at','deleted_at'];
    protected $fillable     = ['requirement_code','master_method_id', 'master_category_id', 'komposisi_specimen', 'parameter',
                                'perlakuan_test', 'operator', 'uom', 'value1','value2', 'value3', 'value4', 'value5', 
                                'value6', 'value7', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'deleted_by'];
    protected $table        = 'master_requirements';
}

