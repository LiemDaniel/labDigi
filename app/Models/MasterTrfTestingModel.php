<?php

namespace App\Models;

use DB;
use Auth;
use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class MasterTrfTestingModel extends Model
{
    use Uuids;
    public $timestamps      = false;
    public $incrementing    = false;
    protected $guarded      = ['id'];
    protected $dates        = ['created_at','updated_at','deleted_at'];
    protected $fillable     = ['no_trf','buyer','factory','user_id',
                                'asal_specimen','category_specimen','type_specimen',
                            'test_required','previous_trf','informasi_tanggal', 'category',
                            'part_of_specimen','po_buyer','mo','is_pobuyer','is_mo','size', 'style',
                            'article_no','color','user_id', 'special_request','return_test_sample',
                        'created_at','updated_at', 'status','isintegrate','testing_method_id','verified_lab_date',
                        'verified_lab_by','testing_date','care_instruction','master_testing_id'];
    protected $table        = 'master_trf_testings';
}
