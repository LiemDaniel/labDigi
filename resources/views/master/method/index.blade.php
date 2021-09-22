@extends('layouts.app', ['active' => 'master_method'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
			<li class="active">Master Method</li>
			<li><a href="{{ route('method.index') }}" id="url_master_data_method_index">Master Method</a></li>

		</ul>
	</div>
</div>
@endsection

@section('content')
<div class="content">
	<div class="row">
		<div class=" panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">&nbsp <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
				<div class="heading-elements">
					{!!
						Form::open([
							'role' 			=> 'form',
							'class'			=>'heading-form',
							'url' 			=> route('method.import'),
							'method' 		=> 'POST',
							'id' 			=> 'upload_file_method',
							'enctype' 		=> 'multipart/form-data'
						])
					!!}
						<input type="file" class="hidden" id="upload_method" name="upload_method" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
						<button type="submit" class="btn btn-success hidden btn-lg" id="submit_button" >Submit</button>
					{!! Form::close() !!}
					<div class="heading-btn">

						<a class="btn btn-primary btn-icon" href="{{ route('method.export')}}" data-popup="tooltip" title="download form import" data-placement="bottom" data-original-title="download form import"><i class="icon-download"></i></a>
						<button type="button" class="btn btn-success btn-icon" id="upload_button" data-popup="tooltip" title="upload form import" data-placement="bottom" data-original-title="upload form import"><i class="icon-upload"></i></button>



					</div>

				</div>
                {{-- <div class="heading-elements">
                        <a href="#" class="btn btn-default" id="btn-add"><i class="icon-plus2 position-left"></i>Create New</a>
                        <a class="btn btn-primary btn-icon" href="{{ route('method.export')}}" data-popup="tooltip" title="download form import" data-placement="bottom" data-original-title="download form import"><i class="icon-download"></i></a>
                        <button type="button" class="btn btn-success btn-icon" id="upload_button" data-popup="tooltip" title="upload form import" data-placement="bottom" data-original-title="upload form import"><i class="icon-upload"></i></button>


                </div> --}}
            </div>
			<div class="panel-body">

				<div class="row form-group">
					<div class="table-responsive">
						<table class ="table table-basic table-condensed" id="method-table">
							<thead>
								<tr>
									<th>Created At</th>
									<th>Method Code</th>
									<th>Method Name</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('modal')
<div id="modal_add" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Edit Method</h5>
			</div>

			<div class="modal-body">
				{{-- <form action="{{ route('method.edit') }}" id="form-edituser"> --}}
					<form action="#" id="form-edituser">
					@csrf
					<div class="row">
						<div class="col-lg-6">
							<label class="display-block text-semibold">METHOD CODE</label>
							<input type="text" name="method_code" id="method_code" class="form-control" required="" style="text-transform: uppercase;">
						</div>

						<div class="col-lg-6">
							<label class="display-block text-semibold"><b>METHOD NAME</b></label>
								<select id="select_factory" class="select form-control">

								</select>
						</div>
					</div>
					<br>
					<div class="row ">
						<div class="col-lg-6">
							<label class="display-block text-semibold">Nama</label>
							<input type="text" name="name" id="name" class="form-control" required="" style="text-transform: uppercase;">
						</div>

						<div class="col-lg-6">
							<label class="display-block text-semibold">Admin Role</label>
							<label class="radio-inline " style="padding-top: 20px;">
								<input type="radio" name="admin" value="true" id="admin">
								<b>YA</b>
							</label>
							<label class="radio-inline" style="padding-top: 20px;">
								<input type="radio" name="admin" value="false" checked="checked" id="admin">
								<b>Tidak</b>
							</label>
						</div>
					</div>
					<br>
					<div class="row ">
						<div class="col-lg-6">
							<label class="display-block text-semibold">Role User</label>
							<select class="select form-control" id="role_user">
								<option>Choose Role</option>
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<button type="submit" class="btn btn-primary" id="btn-save">Save</button>
						<button type="reset" class="btn btn-warning" id="btn-reset">Reset</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>

			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>
	</div>
</div>
{!! Form::hidden('page','index' , array('id' => 'page')) !!}
@endsection

@section('js')
<script type="text/javascript">

function checkHasSource()
{
	var result	= false;
	for(var i in list_methods)
	{
		var methods = list_methods[i];

	}

	return result
}



$('#upload_button').on('click', function ()
{
    $('#upload_method').trigger('click');
});


$('#upload_method').on('change', function ()
{
    $.ajax({
        type: "post",
        url: $('#upload_file_method').attr('action'),
        data: new FormData(document.getElementById("upload_file_method")),
        processData: false,
        contentType: false,
		beforeSend: function ()
              {
                  $.blockUI({
                      message: '<i class="icon-spinner4 spinner"></i>',
                      overlayCSS: {
                          backgroundColor: '#fff',
                          opacity: 0.8,
                          cursor: 'wait'
                      },
                      css: {
                          border: 0,
                          padding: 0,
                          backgroundColor: 'transparent'
                      }
                  });
              },
        complete: function () {
            $.unblockUI();
        },
        success: function (response) {
		$('#upload_file_method').trigger('reset');
		var url = $('#url_master_data_method_index').attr('href');
        document.location.href = url;
        },

        error: function (response) {
            $.unblockUI();
            $('#upload_file_method').trigger('reset');
            if (response['status'] == 500)
                $("#alert_error").trigger("click", 'Please Contact ICT.');

            if (response['status'] == 422)
                $("#alert_error").trigger("click", response.responseJSON);


        }
    })
    .done(function () {
        $('#upload_file_method').trigger('reset');
		$("#alert_success").trigger("click", 'Data successfully saved.');
        $('#method-table').DataTable().ajax.reload();
    });

});

$('#method-table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            pageLength:100,
            scroller:true,
            deferRender:true,
            ajax: {
                type: 'GET',
                url: '{{ route('method.data')}}'
            },
            columns: [
                // {data: 'id', name: 'id',searchable:true,visible:false,orderable:false},
                {data: 'created_at', name: 'created_at',searchable:false,visible:true,orderable:true},
				{data: 'method_code', name: 'method_code',searchable:false,visible:true,orderable:true},
				{data: 'method_name', name: 'method_name',searchable:false,visible:true,orderable:true},
				{data: 'category', name: 'category',searchable:false,visible:true,orderable:true},
                {data: 'action', name: 'action',searchable:false,visible:true,orderable:false},
            ]
        });

		var dtable = $('#method-table').dataTable().api();
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("keyup", function (e) { // Bind our desired behavior
                // If the user pressed ENTER, search
                if (e.keyCode == 13) {
                    // Call the API search function
                    dtable.search(this.value).draw();
                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    dtable.search("").draw();
                }
                return;
        });
        dtable.draw();


</script>
@endsection
