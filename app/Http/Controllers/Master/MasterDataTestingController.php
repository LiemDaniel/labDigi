<?php

namespace App\Http\Controllers\Master;

use DB;
use Auth;
use Excel;
use StdClass;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

use App\masterMethodModel as MasterMethod;
use App\masterTestingModel as MasterTesting;

class MasterDataTestingController extends Controller
{
    public function index(){
    	return view('master.testing.index');
    }

    public function export()
    {
        return Excel::create('upload_testing',function ($excel){
            $excel->sheet('active', function($sheet){
                $sheet->setCellValue('A1','DETAIL_TESTING_ID');
                $sheet->setCellValue('B1','METHOD_CODE');
                $sheet->setCellValue('C1','TESTING_CODE');
                $sheet->setCellValue('D1','TESTING_NAME');
                $sheet->setCellValue('E1','DETAIL1');
                $sheet->setCellValue('F1','DETAIL2');
                $sheet->setCellValue('G1','KETERANGAN');

                $sheet->setWidth('A', 15);
                $sheet->setWidth('B', 15);
                $sheet->setWidth('C', 15);
                $sheet->setWidth('D', 15);
                $sheet->setWidth('E', 20);
                $sheet->setWidth('F', 20);
                $sheet->setWidth('G', 25);

                $sheet->setColumnFormat(array(
                    'A' => '@',
                    'B' => '@',
                    'C' => '@',
                    'D' => '@',
                    'E' => '@',
                    'F' => '@',
                    'G' => '@',
                ));



            });



            $excel->setActiveSheetIndex(0);



        })->export('xlsx');
    }

    public function import(Request $request)
    {
        $array = array();
        if($request->hasFile('upload_testing'))
        {
            $validator = Validator::make($request->all(), [
                'upload_testing' => 'required|not_in:[]'
            ]);

            $path = $request->file('upload_testing')->getRealPath();
            $data = Excel::selectSheets('active')->load($path,function($render){})->get();


        if(!empty($data) && $data->count())
         {

            // $data          = json_decode($request->methods);



            $date          = carbon::now()->toDateTimeString();
            foreach ($data as $key => $item)
            {

                    $method_code                    = $item->method_code;
                    $detail_testing_id              = $item->detail_testing_id;
                    $testing_code                   = $item->testing_code;
                    $testing_name                   = $item->testing_name;
                    $detail1                        = $item->detail1;
                    $detail2                        = $item->detail2;
                    $keterangan                     = $item->keterangan;


                    try
                    {
                        DB::beginTransaction();

                        $check_method = MasterMethod::where([
                            'method_code' => $method_code
                        ])->first();

                        if($check_method){

                            $master_testing = MasterTesting::FirstOrCreate([
                                'master_method_id'      => $check_method->id,
                                'detail_testing_id'     => $detail_testing_id,
                                'testing_code'          => $testing_code,
                                'testing_name'          => $testing_name,
                                'detail_testing_1'      => $detail1,
                                'detail_testing_2'      => $detail2,
                                'keterangan'            => $keterangan,
                                'created_by'            => auth::user()->id,
                                'created_at'            => $date,
                                'updated_at'            => $date,

                            ]);
                        } else{
                            return response()->json('Master Method not found. Check ur file guys.',422);
                        }



                        DB::commit();
                    } catch (Exception $e)
                    {
                        DB::rollBack();
                        $message = $e->getMessage();
                        ErrorHandler::db($message);
                    }
                // }
            }


            return response()->json('Upload done',200);
        }else{
            return response()->json('Data not found.',422);
        }




        }
    }

    public function data(Request $request)
    {
        if ($request->ajax())
        {
            $data = DB::table('get_master_testing')
            ->whereNull('deleted_at')
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
                        'delete' => route('testing.delete',$data->id),
                        'edit' => route('testing.edit',$data->id),
                    ]);

            })
            ->make(true);
        }
    }

    public function delete($id)
    {
        try
        {
            DB::beginTransaction();

            $cekTesting = MasterTesting::find($id);
            if($cekTesting){


                    $masterTesting = MasterTestng::find($id);
                    $masterTesting->update([
                        'deleted_at' => carbon::now()
                    ]);

            }





            DB::commit();

            return redirect()->route('testing.index');
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            ErrorHandler::db($message);
        }
    }


    public function edit($id)
    {
        $testings = DB::table('get_master_testing')->where('id', $id)->get();
        // dd($testing);
        return view('master.testing.edit',compact('testings',$testings));
        // return view('master.method.edit');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $detail_testing_id = $request->detail_testing_id;
        $testing_code = $request->testing_code;
        $testing_name = $request->testing_name;
        $detail_testing_1 = $request->detail_testing_1;
        $detail_testing_2 = $request->detail_testing_2;
        $keterangan = $request->keterangan;
        $method_code   = $request->method_code;
        $date          = carbon::now()->toDateTimeString();

        try
        {
            DB::beginTransaction();

            $methods = MasterTesting::where('id', $id)
            ->update([
                'master_method_id'=> $method_code,
                'detail_testing_id' => $detail_testing_id,
                'testing_code' => $testing_code,
                'testing_name' => $testing_name,
                'detail_testing_1' => $detail_testing_1,
                'detail_testing_2' => $detail_testing_2,
                'keterangan' => $keterangan,
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
        return redirect()->route('testing.index');


    }

}
