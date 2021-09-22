@extends('layouts.app', ['active' => 'menu-trf-verified'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Dashboard</a></li>
			<li class="active">TRF</li>
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
						<table class="table table-basic table-condensed" id="master_data_fabric_testing_table">
							<thead>
								<tr>
									<th>id</th>
									<th>Date Submit</th>
									<th>Buyer</th>
									<th>Factory</th>
									<th>User</th>
									<th>No TRF</th>
									<th>PO/MO</th>
									<th>Size</th>
									<th>Style</th>
									<th>Article No</th>
									<th>Color</th>
									<th>Test Required</th>
									<th>Category</th>
									<th>Category Specimen</th>
									<th>Type Specimen</th>
									<th>Informasi Tanggal</th>
									<th>Status</th>
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
	
	$('#master_data_fabric_testing_table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        pageLength:100,
        deferRender:true,
        ajax: {
            type: 'GET',
            url: '{{ route('dashboardTrf.data')}}',
        },
        columns: [
            {data: 'id', name: 'id',searchable:true,visible:false,orderable:false},
            {data: 'created_at', name: 'created_at',searchable:false,visible:true,orderable:true},
            {data: 'buyer', name: 'buyer',searchable:false,visible:true,orderable:true},
            {data: 'factory', name: 'factory',searchable:false,visible:true,orderable:true},
            {data: 'user_id', name: 'user_id',searchable:false,visible:true,orderable:true},
            {data: 'no_trf', name: 'no_trf',searchable:true,visible:true,orderable:true},
            {data: 'po_buyer', name: 'po_buyer',searchable:true,visible:true,orderable:true},
            {data: 'size', name: 'size',searchable:false,visible:true,orderable:true},
            {data: 'test_required', name: 'test_required',searchable:false,visible:true,orderable:true},
            {data: 'style', name: 'style',searchable:false,visible:true,orderable:true},
            {data: 'article_no', name: 'article_no',searchable:true,visible:true,orderable:true},
            {data: 'color', name: 'color',searchable:false,visible:true,orderable:true},
            {data: 'category', name: 'category',searchable:false,visible:true,orderable:true},
            {data: 'category_specimen', name: 'category_specimen',searchable:false,visible:true,orderable:true},
            {data: 'type_specimen', name: 'type_specimen',searchable:false,visible:true,orderable:true},
            {data: 'informasi_tanggal', name: 'informasi_tanggal',searchable:false,visible:true,orderable:true},
            {data: 'status', name: 'status',searchable:true,visible:true,orderable:true},
            {data: 'action', name: 'action',searchable:false,visible:true,orderable:false},
	    ]
    });

    var dtable = $('#master_data_fabric_testing_table').dataTable().api();
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
