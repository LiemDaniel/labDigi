@extends('layouts.app', ['active' => 'master_requirements'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
			<li class="active">Master Requirements</li>
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
                        <a href="{{route('requirements.create')}}" class="btn btn-default" id="btn-add"><i class="icon-plus2 position-left"></i>Create New</a>


                </div>
            </div>
			<div class="panel-body">

				<div class="row form-group">
					<div class="table-responsive">
						<table class ="table table-basic table-condensed" id="requirements-table">
							<thead>
								<tr>
									<th>Created At</th>
									<th>Requirements Code</th>
									<th>Method Code</th>
									<th>Category</th>
                                    <th>Komposisi Specimen</th>
                                    <th>Parameter</th>
                                    <th>Perlakuan Test</th>
                                    <th>Operator</th>
                                    <th>UOM</th>
                                    <th>Value 1</th>
                                    <th>Value 2</th>
                                    <th>Value 3</th>
                                    <th>Value 4</th>
                                    <th>Value 5</th>
                                    <th>Value 6</th>
                                    <th>Value 7</th>
                                    <th>Remarks</th>
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
        complete: function () {
            $.unblockUI();
        },
        success: function (response) {
            $("#alert_info").trigger("click", 'Upload success, please check again before save.');
            // for (idx in response) {
            //     var data = response[idx];


            //     var input = {
            //         'method_code'	        : data.method_code,
			// 		'method_name'	        : data.method_name,
			// 		'category'		        : data.category,

            //     };

            //     list_materials.push(input);
            // }

            //list_materials = response;
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
        render();
    });

});

        $('#requirements-table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            pageLength:100,
            scroller:true,
            deferRender:true,
            ajax: {
                type: 'GET',
                url: '{{ route('requirements.data')}}'
            },
            columns: [
                // {data: 'id', name: 'id',searchable:true,visible:false,orderable:false},
                {data: 'created_at', name: 'created_at',searchable:false,visible:true,orderable:true},
				{data: 'requirement_code', name: 'requirement_code',searchable:false,visible:true,orderable:true},
				{data: 'method_code', name: 'method_code',searchable:false,visible:true,orderable:true},
				{data: 'category', name: 'category',searchable:false,visible:true,orderable:true},
				{data: 'komposisi_specimen', name: 'komposisi_specimen',searchable:false,visible:true,orderable:true},
				{data: 'parameter', name: 'parameter',searchable:false,visible:true,orderable:true},
				{data: 'perlakuan_test', name: 'perlakuan_test',searchable:false,visible:true,orderable:true},
				{data: 'operator', name: 'operator',searchable:false,visible:true,orderable:true},
				{data: 'uom', name: 'uom',searchable:false,visible:true,orderable:true},
				{data: 'value1', name: 'value1',visible:true,orderable:true},
                {data: 'value2', name: 'value2',visible:true,orderable:true},
                {data: 'value3', name: 'value3',visible:true,orderable:true},
                {data: 'value4', name: 'value4',visible:true,orderable:true},
                {data: 'value5', name: 'value5',visible:true,orderable:true},
                {data: 'value6', name: 'value6',visible:true,orderable:true},
                {data: 'value7', name: 'value7',visible:true,orderable:true},
                {data: 'remarks', name: 'remarks',visible:true,orderable:true},
                {data: 'action', name: 'action',searchable:false,visible:true,orderable:false},
            ]
        });

		var dtable = $('#requirements-table').dataTable().api();
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
