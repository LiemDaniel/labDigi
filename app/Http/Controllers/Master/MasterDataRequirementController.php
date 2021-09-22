<?php

namespace App\Http\Controllers\Master;

use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;


use App\masterMethodModel as MasterMethod;
use App\masterOperatorModel as MasterOperator;
use App\masterCategoryModel as MasterCategory;
use App\masterRequirementModel as MasterRequirement;

class MasterDataRequirementController extends Controller
{
    public function index(){
    	return view('master.requirements.index');
    }

    public function create(){

        $method     = MasterMethod::pluck('method_code', 'id');
        $operators  = MasterOperator::pluck('operator_name', 'id');
        $category   = MasterCategory::distinct()->pluck('category');
        // dd($category);

        return view('master.requirements.create', [
            'methods' => $method,
            'operators'=> $operators,
            'categories' => $category
        ]);

    	// return view('master.requirements.create');
    }

    public function getMethods(Request $request)
    {
        if(!$request->id)
        {
            $data = ['null'];
        } else
        {
            $id = $request->id;
            $data = MasterMethod::where('id', $id)->whereNull('deleted_at')->first();

        }

        return response()->json(['data' => $data]);

    }

    public function getCategories(Request $request)
    {
    //    dd($request->category);
        if(!$request->category)
        {
            $data = ['null'];
        } else
        {
            $category = $request->category;
            $data = MasterCategory::select('category_specimen')
            ->distinct()
            ->where('category', $category)
            ->whereNull('deleted_at')->get();

        }
        // dd($data);
        return response()->json(['response' => $data],200);

    }

    public function getCategorySpecimen(Request $request)
    {
    //    dd($request->category);
        if(!$request->category_specimen && !$request->category)
        {
            $data = ['null'];
            $notif = 500;
        } else
        {
            $category_specimen = $request->category_specimen;
            $category = $request->category;

            $data = MasterCategory::distinct()
            ->where('category', $category)
            ->where('category_specimen', $category_specimen)
            ->whereNull('deleted_at')->get();
            $notif = 200;
        }
        // dd($data);
        return response()->json(['response' => $data],$notif);

    }

    public function save(Request $request)
    {
    //    dd($request->requirement_id);

        if ($request)
        {
            $requirement_id 	= $request->requirement_id;
            $method_code 		= $request->method_code;
            $category			= $request->category;
            $category_specimen	= $request->category_specimen;
            $type_specimen	 	= $request->type_specimen;
            $komposisi_specimen	= $request->komposisi_specimen;
            $parameter			= $request->parameter;
            $perlakuan_tes		= $request->perlakuan_tes;
            $operator_id		= $request->operator_id;
            $value1				= $request->value1;
            $value2				= $request->value2;
            $value3				= $request->value3;
            $value4				= $request->value4;
            $value5				= $request->value5;
            $value6				= $request->value6;
            $value7				= $request->value7;
            $uom				= $request->uom;
            $remarks			= $request->remarks;
            $date               = carbon::now()->toDateTimeString();

            $method_id          = MasterMethod::where([
                                    'id' => $method_code
                                    ])->whereNull('deleted_at')->first();

            $category_id        = MasterCategory::where([
                                    'category'          => $category,
                                    'category_specimen' => $category_specimen,
                                    'type_specimen'     => $type_specimen
                                    ])->whereNull('deleted_at')->first();
            // dd($method_id);

            if(!$method_id)
            {
                $data = 'method';
                $notif = 500;
            } else if (!$category_id)
            {
                $data = 'category';
                $notif = 500;
            } else
            {


                $master_requirement = MasterRequirement::firstOrCreate([
                    'requirement_code'      => $requirement_id,
                    'master_method_id'      => $method_id->id,
                    'master_category_id'    => $category_id->id,
                    'komposisi_specimen'    => $komposisi_specimen,
                    'parameter'             => $parameter,
                    'perlakuan_test'        => $perlakuan_tes,
                    'operator'              => $operator_id,
                    'uom'                   => $uom,
                    'value1'                => $value1,
                    'value2'                => $value2,
                    'value3'                => $value3,
                    'value4'                => $value4,
                    'value5'                => $value5,
                    'value6'                => $value6,
                    'value7'                => $value7,
                    'remarks'               => $remarks,
                    'created_at'            => $date,
                    'created_by'            => auth::user()->id,
                ]);
                $data = 'success';
                $notif = 200;
            }

        }else
        {
            $data = 'gagal';
            $notif = 500;
        }

        return response()->json(['response' => $data],$notif);
    }

    public function data(Request $request)
    {
        if ($request->ajax())
        {
            $data = DB::table('get_master_requirements')->whereNull('deleted_at')
            ->orderby('created_at','desc');

            // dd($data);

            return DataTables::of($data)
            ->editColumn('created_at',function ($data)
            {
                return  Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d/M/Y H:i:s');
            })
            ->addColumn('action', function($data)
            {
                return view('master._action', [
                    'model' => $data,
                    'delete' => route('requirements.delete',$data->id),
                    'edit' => route('requirements.edit',$data->id),
                ]);

            })
            ->make(true);
        }
    }

    public function edit($id)
    {
        $requirements = DB::table('get_master_requirements')->where('id', $id)->get();
        // dd($testing);
        return view('master.requirements.edit',compact('requirements',$requirements));
        // return view('master.method.edit');
    }

    public function update(Request $request)
    {
        // dd($request);
        $date = carbon::now()->toDateTimeString();

        try{
            DB::beginTransaction();

            $methods = MasterRequirement::where('id', $request->id)
                ->update([
                    'requirement_code'   => $request->requirement_code,
                    'master_method_id'   => $request->method_id,
                    'master_category_id' => $request->master_category_id,
                    'komposisi_specimen' => $request->komposisi_specimen,
                    'parameter'   => $request->parameter,
                    'perlakuan_test' => $request->perlakuan_test,
                    'operator' => $request->operator,
                    'uom' => $request->uom,
                    'value1' => $request->value1,
                    'value2' => $request->value2,
                    'value3' => $request->value3,
                    'value4' => $request->value4,
                    'value5' => $request->value5,
                    'value6' => $request->value6,
                    'value7' => $request->value7,
                    'remarks' => $request->remarks,
                    'updated_at' => $date
                ]);

            DB::commit();
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $e->getMessage();
            ErrorHandler::db($message);
        }

        // return response()->json('Upload done',200);
        return redirect()->route('requirements.index');
    }

}
