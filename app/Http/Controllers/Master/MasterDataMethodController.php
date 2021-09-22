<?php

namespace App\Http\Controllers\Master;

use DB;
use Auth;
use Excel;
use StdClass;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\DataTables;
use App\Http\Controllers\Controller;


use App\masterMethodModel as MasterMethod;
use App\masterTestingModel as MasterTesting;

class MasterDataMethodController extends Controller
{
    public function index(){
    	return view('master.method.index');
    }


    public function data(Request $request)
    {
        if ($request->ajax())
        {
            $data = MasterMethod::whereNull('deleted_at')
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
                        'delete' => route('method.delete',$data->id),
                        'edit' => route('method.edit',$data->id),
                    ]);

            })
            ->make(true);
        }
    }


    public function export()
    {
        return Excel::create('upload_method',function ($excel){
            $excel->sheet('active', function($sheet){
                $sheet->setCellValue('A1','METHOD_CODE');
                $sheet->setCellValue('B1','METHOD_NAME');
                $sheet->setCellValue('C1','CATEGORY');

                $sheet->setWidth('A', 15);
                $sheet->setWidth('B', 15);
                $sheet->setWidth('C', 15);

                $sheet->setColumnFormat(array(
                    'A' => '@',
                    'B' => '@',
                    'C' => '@',
                ));



            });



            $excel->setActiveSheetIndex(0);



        })->export('xlsx');
    }

    public function import(Request $request)
    {
        $array = array();
        if($request->hasFile('upload_method'))
        {
            $validator = Validator::make($request->all(), [
                'upload_method' => 'required|not_in:[]'
            ]);

            $path = $request->file('upload_method')->getRealPath();
            $data = Excel::selectSheets('active')->load($path,function($render){})->get();


        if(!empty($data) && $data->count())
         {

            // $data          = json_decode($request->methods);



            $date          = carbon::now()->toDateTimeString();
            foreach ($data as $key => $item)
            {


                    $method_code                    = $item->method_code;
                    $method_name                    = $item->method_name;
                    $category                       = $item->category;

                    // $cek_method = MasterMethod::where('method_code', $method_code)
                    //             ->where('method_name', $method_name)
                    //             ->where('category', $category)
                    //             ->whereNull('deleted_at')->first();

                    // dd($cek_method);
                    // if($cek_method == null)
                    // {
                    //     return response()->json('Data is already exist.',422);
                    // } else{
                        try
                        {
                            DB::beginTransaction();

                            $master_methods = MasterMethod::FirstOrCreate([
                                'method_code'           => $method_code,
                                'method_name'           => $method_name,
                                'category'              => $category,
                                'created_at'            => $date,
                                'updated_at'            => $date,

                            ]);

                            DB::commit();
                        } catch (Exception $e)
                        {
                            DB::rollBack();
                            $message = $e->getMessage();
                            ErrorHandler::db($message);
                        }
                    // }


                // }
            }


            return response()->json('Upload done',200);
        }else{
            return response()->json('Data not found.',422);
        }




        }
    }

    public function delete($id)
    {
        try
        {
            DB::beginTransaction();

            $cekMethod = MasterMethod::find($id);
            if($cekMethod){
                $masterTesting = MasterTesting::find($id);
                if($masterTesting){
                    return response()->json('Hapus data di master testing duulu', 422);
                } else{

                    $masterMethod = MasterMethod::find($id);
                    $masterMethod->update([
                        'deleted_at' => carbon::now()
                    ]);
                }
            }





            DB::commit();

            return redirect()->route('method.index');
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            ErrorHandler::db($message);
        }
    }


    public function edit($id)
    {
        $methods = MasterMethod::where('id', $id)->get();



        return view('master.method.edit',compact('methods', $methods));
        // return view('master.method.edit');
    }

    public function update(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $method_code = $request->method_code;
        $method_name = $request->method_name;
        $category = $request->category;
        $date = carbon::now()->toDateTimeString();

        try{
            DB::beginTransaction();

            $methods = MasterMethod::where('id', $id)
                ->update([
                    'method_code'=> $method_code,
                    'method_name' => $method_name,
                    'category'    => $category,
                    'updated_at'    =>$date
                ]);

            DB::commit();
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $e->getMessage();
            ErrorHandler::db($message);
        }

        // return response()->json('Upload done',200);
        return redirect()->route('method.index');


    }
}
