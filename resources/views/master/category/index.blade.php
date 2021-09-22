@extends('layouts.app', ['active' => 'master_category'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
			<li class="active">Master Category</li>
            <li><a href="{{ route('category.index') }}" id="url_master_data_category_index">Master Category</a></li>
				
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
							'url' 			=> route('category.import'),
							'method' 		=> 'POST',
							'id' 			=> 'upload_file_category',
							'enctype' 		=> 'multipart/form-data'
						])
					!!}
						<input type="file" class="hidden" id="upload_category" name="upload_category" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
						<button type="submit" class="btn btn-success hidden btn-lg" id="submit_button" >Submit</button>
					{!! Form::close() !!}
					<div class="heading-btn">
	
						<a class="btn btn-primary btn-icon" href="{{ route('category.export')}}" data-popup="tooltip" title="download form import" data-placement="bottom" data-original-title="download form import"><i class="icon-download"></i></a>
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
						<table class ="table table-basic table-condensed" id="category-table">
							<thead>
								<tr>
									<th>Created At</th>
									<th>Category</th>
									<th>Category Specimen</th>
									<th>Type Specimen</th>
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
    $('#upload_category').trigger('click');
});


$('#upload_category').on('change', function () 
{
    $.ajax({
        type: "post",
        url: $('#upload_file_category').attr('action'),
        data: new FormData(document.getElementById("upload_file_category")),
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
            $('#upload_file_category').trigger('reset');
		    var url = $('#url_master_data_category_index').attr('href'); 
            document.location.href = url;
        },
        error: function (response) {
            $.unblockUI();
            $('#upload_file_category').trigger('reset');
            if (response['status'] == 500)
                $("#alert_error").trigger("click", 'Please Contact ICT.');

            if (response['status'] == 422)
                $("#alert_error").trigger("click", response.responseJSON);

        }
    })
    .done(function () {
        $('#upload_file_category').trigger('reset');
        $("#alert_success").trigger("click", 'Data successfully saved.');
        $('#category-table').DataTable().ajax.reload();
    });

});

$('#-table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            pageLength:100,
            scroller:true,
            deferRender:true,
            ajax: {
                type: 'GET',
                url: '{{ route('category.data')}}'
            },
            columns: [
                // {data: 'id', name: 'id',searchable:true,visible:false,orderable:false},
                {data: 'created_at', name: 'created_at',searchable:false,visible:true,orderable:true},
				{data: 'category', name: 'category',searchable:false,visible:true,orderable:true},
				{data: 'category_specimen', name: 'category_specimen',searchable:false,visible:true,orderable:true},
				{data: 'type_specimen', name: 'type_specimen',searchable:false,visible:true,orderable:true},
                {data: 'action', name: 'action',searchable:false,visible:true,orderable:false},
            ]
        });

		var dtable = $('#category-table').dataTable().api();
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