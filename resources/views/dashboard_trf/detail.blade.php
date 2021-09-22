@extends('layouts.app', ['active' => 'menu-dashboard-trf'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
			<li class="active">Master Testing</li>
		</ul>
	</div>
</div>
@endsection



@section('content')
<div class="content">
	<div class="row">
		<div class=" panel panel-flat">
            <div class="panel-heading">

            </div>
			<div class="panel-body">
				<form action="{{ route ('dashboardTrf.update')}}" id="form-update" method="POST">
					{{ csrf_field() }}

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Master Data Fabric Testing Code</label>
                                            <input type="hidden" name="id" id="id" value = "{{ $master_data_fabric_testing->id}}"class="form-control">

                                            <input type="text" name="no_trf" id="no_trf" value = "{{ $master_data_fabric_testing->no_trf}}" class="form-control" placeholder="Input Method code ">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Buyer</label>

                                            <input type="text" name="buyer" id="buyer" class="form-control" value = "{{ $master_data_fabric_testing->buyer}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Factory</label>

                                            <input type="text" name="factory" id="factory" class="form-control" value = "{{ $master_data_fabric_testing->factory}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">User Id</label>

                                            <input type="text" name="user_id" id="user_id" class="form-control" value = "{{ $user->name}}" placeholder="Input Method name " readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Asal Specimen</label>

                                            <input type="text" name="asal_specimen" id="asal_specimen" class="form-control" value = "{{ $master_data_fabric_testing->asal_specimen}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Category Specimen</label>

                                            <input type="text" name="category_specimen" id="category_specimen" class="form-control" value = "{{ $master_data_fabric_testing->category_specimen}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Type Specimen</label>

                                            <input type="text" name="type_specimen" id="type_specimen" class="form-control" value = "{{ $master_data_fabric_testing->type_specimen}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Test Required</label>

                                            <input type="text" name="test_required" id="test_required" class="form-control" value = "{{ $master_data_fabric_testing->test_required}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Previous Trf</label>

                                            <input type="text" name="previous_trf" id="previous_trf" class="form-control" value = "{{ $master_data_fabric_testing->previous_trf}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Informasi Tanggal</label>

                                            <input type="text" name="informasi_tanggal" id="informasi_tanggal" class="form-control" value = "{{ $master_data_fabric_testing->informasi_tanggal}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Category</label>

                                            <input type="text" name="category" id="category" class="form-control" value = "{{ $master_data_fabric_testing->category}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Part Of Specimen</label>

                                            <input type="text" name="part_of_specimen" id="part_of_specimen" class="form-control" value = "{{ $master_data_fabric_testing->part_of_specimen}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">PO Buyer</label>

                                            <input type="text" name="po_buyer" id="po_buyer" class="form-control" value = "{{ $master_data_fabric_testing->po_buyer}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">MO</label>

                                            <input type="text" name="mo" id="mo" class="form-control" value = "{{ $master_data_fabric_testing->mo}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Size</label>

                                            <input type="text" name="size" id="size" class="form-control" value = "{{ $master_data_fabric_testing->size}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Style</label>

                                            <input type="text" name="style" id="style" class="form-control" value = "{{ $master_data_fabric_testing->style}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Article No</label>

                                            <input type="text" name="article_no" id="article_no" class="form-control" value = "{{ $master_data_fabric_testing->article_no}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Color</label>

                                            <input type="text" name="color" id="color" class="form-control" value = "{{ $master_data_fabric_testing->color}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Special Request</label>

                                            <input type="text" name="special_request" id="special_request" class="form-control" value = "{{ $master_data_fabric_testing->special_request}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Return Test Sample</label>

                                            <input type="text" name="return_test_sample" id="return_test_sample" class="form-control" value = "{{ $master_data_fabric_testing->return_test_sample}}" placeholder="Input Method name ">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Status</label>

                                            <input type="text" name="status" id="status" class="form-control" value = "{{ $master_data_fabric_testing->status}}" placeholder="Input Method name " readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Testing Method Code</label>

                                            <input type="text" name="testing_method_id" id="testing_method_id" class="form-control" value = "{{ $master_method->method_name}}" placeholder="Input Method name " readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Master Testing Code</label>

                                            <input type="text" name="master_testing_id" id="master_testing_id" class="form-control" value = "{{ $master_testing->testing_code}}" placeholder="Input Method name " readonly>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

					<button type="submit" class="btn btn-blue-success col-xs-12" style="margin-top: 15px">Update <i class="icon-floppy-disk position-right"></i></button>

				</form>

			</div>
		</div>
	</div>
</div>
@endsection




@section('js')
<script type="text/javascript">
    $(document).ready(function() {

        $(function() {

            let status = $('#status').val();

            // TODO
            // Approve nya tulisan nya gimana ?
            if(status == 'approved') {
                $('.form-control').attr('readonly', true);
            }
        })
    })

</script>
@endsection
