<?php

namespace App;

use DB;
use Auth;
use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class masterCategoryModel extends Model
{
    use Uuids;
    public $timestamps      = false;
    public $incrementing    = false;
    protected $guarded      = ['id'];
    protected $dates        = ['created_at','updated_at','deleted_at'];
    protected $fillable     = ['category' , 'category_specimen', 'type_specimen', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'deleted_by'];
    protected $table        = 'master_category';
}
