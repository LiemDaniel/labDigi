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

use App\masterCategoryModel as MasterCategory;

class MasterDataCategoryController extends Controller
{
    public function index(){
    	return view('master.category.index');
    }

    public function export()
    {
        return Excel::create('upload_category',function ($excel){
            $excel->sheet('active', function($sheet){
                $sheet->setCellValue('A1','CATEGORY');
                $sheet->setCellValue('B1','CATEGORY_SPECIMEN');
                $sheet->setCellValue('C1','TYPE_SPECIMEN');

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
        if($request->hasFile('upload_category'))
        {
            $validator = Validator::make($request->all(), [
                'upload_category' => 'required|not_in:[]'
            ]);
          
            $path = $request->file('upload_category')->getRealPath();
            $data = Excel::selectSheets('active')->load($path,function($render){})->get();

           
        if(!empty($data) && $data->count())
         {
            
            // $data          = json_decode($request->methods);
    
           

            $date          = carbon::now()->toDateTimeString();
            foreach ($data as $key => $item) 
            {
                
                    $category                    = $item->category;
                    $category_specimen           = $item->category_specimen;
                    $type_specimen               = $item->type_specimen;


                    try 
                    {
                        DB::beginTransaction();

                        $check_category = MasterCategory::where([
                            'category'          => $category,
                            'category_specimen' => $category_specimen,
                            'type_specimen'     => $type_specimen
                        ])->first();
                        
                        if(!$check_category){

                            $master_category = MasterCategory::FirstOrCreate([
                                'category'              => $category,
                                'category_specimen'     => $category_specimen,
                                'type_specimen'         => $type_specimen,
                                'created_by'            => auth::user()->id,
                                'created_at'            => $date,
                                'updated_at'            => $date,
    
                            ]);
                        } else{
                            return response()->json('Master Category is already exist. Check ur file guys.',422);
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
            $data = MasterCategory::whereNull('deleted_at')
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
                        'delete' => route('category.delete',$data->id),
                        'edit' => route('category.edit',$data->id),
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
            
            $cekCategory = MasterCategory::find($id);
            if($cekCategory){
               
    
                    $masterCategory = MasterCategory::find($id);
                    $masterCategory->update([
                        'deleted_at' => carbon::now()
                    ]);
                
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
        $category = MasterCategory::where('id', $id)->get();



        return view('master.category.edit',compact('category', $category));
        // return view('master.method.edit');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $category = $request->category;
        $category_specimen = $request->category_specimen;
        $type_specimen = $request->type_specimen;
        $date          = carbon::now()->toDateTimeString();

        try 
        {
            DB::beginTransaction();
            
            $category = MasterCategory::where('id', $id)
            ->update([
                'category'=> $category,
                'category_specimen' => $category_specimen,
                'type_specimen'    => $type_specimen,
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
        return redirect()->route('category.index');

       
    }

}
