<?php

namespace App\Http\Controllers\Trf;

use DB;
use Auth;
use Excel;
use StdClass;
use Validator;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MasterTrfTestingModel;

class DashboardTrfController extends Controller
{
    public function index()
    {
        return view('dashboard_trf.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $fabric_testing = MasterTrfTestingModel::whereNull('deleted_at')
                ->where('status', 'OPEN')
                ->orderBy('created_at', 'desc');


            return DataTables::of($fabric_testing)
                ->editColumn('user_id', function ($fabric_testing) {
                    return $fabric_testing->user_id;
                })
                ->editColumn('factory', function ($fabric_testing) {
                    if ($fabric_testing->factory == 'aoi1') return 'AOI 1';
                    elseif ($fabric_testing->factory == 'aoi2') return 'AOI 2';
                    else return 'BBIS';
                })
                ->editColumn('informasi_tanggal', function ($fabric_testing) {
                    if ($fabric_testing->informasi_tanggal == 'buy_ready') return 'Buy Ready';
                    elseif ($fabric_testing->informasi_tanggal == 'output_sewing') return '1st Output Sewing';
                    else return 'PODD';
                })
                ->editColumn('test_required', function ($fabric_testing) {
                    if ($fabric_testing->test_required == 'developtesting_t1') return 'Develop Testing T1';
                    elseif ($fabric_testing->test_required == 'developtesting_t2') return 'Develop Testing T2';
                    elseif ($fabric_testing->test_required == 'developtesting_selective') return 'Develop Testing Selective';
                    elseif ($fabric_testing->test_required == 'bulktesting_m') return '1st Bulk Testing M (Model Level)';
                    elseif ($fabric_testing->test_required == 'bulktesting_a') return '1st Bulk Testing A (Article Level)';
                    elseif ($fabric_testing->test_required == 'bulktesting_selective') return '1st Bulk Testing Selective';
                    elseif ($fabric_testing->test_required == 'reordertesting_m') return 'Re-Order Testing M (Model Level)';
                    elseif ($fabric_testing->test_required == 'reordertesting_a') return 'Re-Order Testing A (Article Level)';
                    elseif ($fabric_testing->test_required == 'reordertesting_selective') return 'Re-Order Testing Selective';
                    else return 'Re-Test';
                })
                ->editColumn('status', function ($fabric_testing) {
                    if ($fabric_testing->status == 'OPEN') return 'OPEN';
                    elseif ($fabric_testing->status == 'VERIFIED') return 'VERIFIED';
                    elseif ($fabric_testing->status == 'REJECTED') return 'REJECTED';
                    elseif ($fabric_testing->status == 'ONPROGRESS') return 'ONPROGRESS';
                    elseif ($fabric_testing->status == 'CLOSED') return 'CLOSED';
                    else return 'eror';
                })


                ->addColumn('action', function ($fabric_testing) {
                    return view('dashboard_trf._action', [
                        'model'  => $fabric_testing,
                        'approval'   => route('dashboardTrf.approval', $fabric_testing->id),
                        'detil'   => route('dashboardTrf.detail', $fabric_testing->id),
                        // 'print_notrf'   => route('masterDataFabricTesting.barcode', $fabric_testing->id),
                        // 'delete' => route('masterDataFabricTesting.delete',$fabric_testing->id),
                    ]);
                })
                ->make(true);
        }
    }

    public function searchstatus(Request $request)
    {
        $status = $request->status;
        // dd($status);
        $fabric_testing = MasterTrfTestingModel::whereNull('deleted_at')
            ->where('status', $status)
            ->orderBy('created_at', 'desc');


        return DataTables::of($fabric_testing)
            ->editColumn('user_id', function ($fabric_testing) {
                return $fabric_testing->user_id;
            })
            ->editColumn('factory', function ($fabric_testing) {
                if ($fabric_testing->factory == 'aoi1') return 'AOI 1';
                elseif ($fabric_testing->factory == 'aoi2') return 'AOI 2';
                else return 'BBIS';
            })
            ->editColumn('informasi_tanggal', function ($fabric_testing) {
                if ($fabric_testing->informasi_tanggal == 'buy_ready') return 'Buy Ready';
                elseif ($fabric_testing->informasi_tanggal == 'output_sewing') return '1st Output Sewing';
                else return 'PODD';
            })
            ->editColumn('test_required', function ($fabric_testing) {
                if ($fabric_testing->test_required == 'developtesting_t1') return 'Develop Testing T1';
                elseif ($fabric_testing->test_required == 'developtesting_t2') return 'Develop Testing T2';
                elseif ($fabric_testing->test_required == 'developtesting_selective') return 'Develop Testing Selective';
                elseif ($fabric_testing->test_required == 'bulktesting_m') return '1st Bulk Testing M (Model Level)';
                elseif ($fabric_testing->test_required == 'bulktesting_a') return '1st Bulk Testing A (Article Level)';
                elseif ($fabric_testing->test_required == 'bulktesting_selective') return '1st Bulk Testing Selective';
                elseif ($fabric_testing->test_required == 'reordertesting_m') return 'Re-Order Testing M (Model Level)';
                elseif ($fabric_testing->test_required == 'reordertesting_a') return 'Re-Order Testing A (Article Level)';
                elseif ($fabric_testing->test_required == 'reordertesting_selective') return 'Re-Order Testing Selective';
                else return 'Re-Test';
            })
            ->editColumn('status', function ($fabric_testing) {
                if ($fabric_testing->status == 'OPEN') return '<span class="label label-warning">OPEN</span>';
                elseif ($fabric_testing->status == 'VERIFIED') return '<span class="label label-warning">VERIFIED</span>';
                elseif ($fabric_testing->status == 'VERIFIED') return '<span class="label label-warning">VERIFIED</span>';
                else return 'BBIS';
            })


            ->addColumn('action', function ($fabric_testing) {
                return view('dashboard_trf._action', [
                    'model'  => $fabric_testing,
                    // 'edit'   => route('masterDataFabricTesting.edit',$fabric_testing->id),
                    // 'print_notrf'   => route('masterDataFabricTesting.barcode', $fabric_testing->id),
                    // 'delete' => route('masterDataFabricTesting.delete',$fabric_testing->id),
                ]);
            })
            ->make(true);
    }

    public function approval($id)
    {
        try {
            DB::beginTransaction();


            $masterTrf = MasterTrfTestingModel::find($id);
            $masterTrf->update([
                'verified_lab_date' => carbon::now(),
                'verified_lab_by'   => auth::user()->id,
                'updated_at'        => carbon::now(),
                'status'            => 'VERIFIED'
            ]);

            DB::commit();

            return redirect()->route('dashboardTrf.index');
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            ErrorHandler::db($message);
        }
    }

    public function reject($id)
    {
        try {
            DB::beginTransaction();


            $masterTrf = MasterTrfTestingModel::find($id);
            $masterTrf->update([
                // 'verified_lab_date' => carbon::now(),
                'reject_by'         => auth::user()->id,
                'updated_at'        => carbon::now(),
                'status'            => 'REJECT'
            ]);


            DB::commit();

            return redirect()->route('dashboardTrf.index');
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            ErrorHandler::db($message);
        }
    }

    public function index_verified()
    {
        return view('dashboard_trf.index_verified');
    }

    public function data_verified(Request $request)
    {
        if ($request->ajax()) {
            $fabric_testing = MasterTrfTestingModel::whereNull('deleted_at')
                ->where('status', 'VERIFIED')
                ->orderBy('created_at', 'desc');





            return DataTables::of($fabric_testing)
                ->editColumn('user_id', function ($fabric_testing) {
                    return $fabric_testing->user_id;
                })
                ->editColumn('factory', function ($fabric_testing) {
                    if ($fabric_testing->factory == 'aoi1') return 'AOI 1';
                    elseif ($fabric_testing->factory == 'aoi2') return 'AOI 2';
                    else return 'BBIS';
                })
                ->editColumn('informasi_tanggal', function ($fabric_testing) {
                    if ($fabric_testing->informasi_tanggal == 'buy_ready') return 'Buy Ready';
                    elseif ($fabric_testing->informasi_tanggal == 'output_sewing') return '1st Output Sewing';
                    else return 'PODD';
                })
                ->editColumn('test_required', function ($fabric_testing) {
                    if ($fabric_testing->test_required == 'developtesting_t1') return 'Develop Testing T1';
                    elseif ($fabric_testing->test_required == 'developtesting_t2') return 'Develop Testing T2';
                    elseif ($fabric_testing->test_required == 'developtesting_selective') return 'Develop Testing Selective';
                    elseif ($fabric_testing->test_required == 'bulktesting_m') return '1st Bulk Testing M (Model Level)';
                    elseif ($fabric_testing->test_required == 'bulktesting_a') return '1st Bulk Testing A (Article Level)';
                    elseif ($fabric_testing->test_required == 'bulktesting_selective') return '1st Bulk Testing Selective';
                    elseif ($fabric_testing->test_required == 'reordertesting_m') return 'Re-Order Testing M (Model Level)';
                    elseif ($fabric_testing->test_required == 'reordertesting_a') return 'Re-Order Testing A (Article Level)';
                    elseif ($fabric_testing->test_required == 'reordertesting_selective') return 'Re-Order Testing Selective';
                    else return 'Re-Test';
                })
                ->editColumn('status', function ($fabric_testing) {
                    if ($fabric_testing->status == 'OPEN') return 'OPEN';
                    elseif ($fabric_testing->status == 'VERIFIED') return 'VERIFIED';
                    elseif ($fabric_testing->status == 'REJECTED') return 'REJECTED';
                    elseif ($fabric_testing->status == 'ONPROGRESS') return 'ONPROGRESS';
                    elseif ($fabric_testing->status == 'CLOSED') return 'CLOSED';
                    else return 'eror';
                })


                ->addColumn('action', function ($fabric_testing) {
                    return view('dashboard_trf._action', [
                        'model'  => $fabric_testing,
                        'approval'   => route('dashboardTrf.approval', $fabric_testing->id),
                        // 'print_notrf'   => route('masterDataFabricTesting.barcode', $fabric_testing->id),
                        // 'delete' => route('masterDataFabricTesting.delete',$fabric_testing->id),
                    ]);
                })
                ->make(true);
        }
    }

    public function detail($id){

        $master_data_fabric_testing = DB::table('master_trf_testings')
            ->where('master_trf_testings.id', $id)
            ->first();

        $master_testing = DB::table('master_testing')
            ->where('master_method_id', $master_data_fabric_testing->master_testing_id)
            ->first();

        $master_method = DB::table('master_method')
            ->where('id', $master_data_fabric_testing->testing_method_id)
            ->first();

        $user = DB::connection('user_wms')
            ->table('users')
            ->where('id', $master_data_fabric_testing->user_id)
            ->first();


        // TODO
        // dd($user);

        return view('dashboard_trf.detail', compact('master_data_fabric_testing', 'master_testing', 'master_method', 'user'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $date = carbon::now()->toDateTimeString();

        try{
            DB::beginTransaction();

            $methods = MasterTrfTestingModel::where('id', $request->id)
                ->update([
                    'no_trf' => $request->no_trf,
                    'factory' => $request->factory,
                    'buyer' => $request->buyer,
                    'asal_specimen' => $request->asal_specimen,
                    'category_specimen' => $request->category_specimen,
                    'type_specimen' => $request->type_specimen,
                    'test_required' => $request->test_required,
                    'previous_trf' => $request->previous_trf,
                    'category' => $request->category,
                    'part_of_specimen' => $request->part_of_specimen,
                    'po_buyer' => $request->po_buyer,
                    'mo' => $request->mo,
                    'size' => $request->size,
                    'style' => $request->style,
                    'article_no' => $request->article_no,
                    'color' => $request->color,
                    'special_request' => $request->special_request,
                    'return_test_sample' => $request->return_test_sample,
                    'update_at' => $date
                ]);

                // 'status' => $request->status,
                // 'master_testing_id' => $request->master_testing_id,
                // 'testing_method_id' => $request->testing_method_id,
                // 'user_id' => $request->user_id,

            DB::commit();
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $e->getMessage();
            ErrorHandler::db($message);
        }

        // return response()->json('Upload done',200);
        return redirect()->route('dashboardTrf.index');
    }
}
