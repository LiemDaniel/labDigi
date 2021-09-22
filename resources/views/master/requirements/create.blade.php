@extends('layouts.app', ['active' => 'master_requirements'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
			<li class="active">Master Requirements</li>
            <li class="active">Create New</li>
		</ul>
	</div>
</div>
@endsection

@section('content')
<div class="content">
	<div class="row">
		<div class=" panel panel-flat">
            
			<div class="panel-body">
				
                <form action="{{ route('requirements.save') }}" id="form-create" method="POST">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-lg-6">
							<div class="row">
								<label class="display-block text-semibold">Requirement ID</label>
								<input type="text" name="requirement_id" id="requirement_id" class="form-control" required="" style="text-transform: uppercase;">
							</div>
							<div class="row">
								<label class="display-block text-semibold">Method Code</label>
                                <select name="method_code" id="method_code" class="form-control select">
                                    <option value="">== Select Method ==</option>
                                    @foreach ($methods as $id => $method_code)
                                        <option value="{{ $id }}">{{ $method_code }}</option>
                                    @endforeach
                                </select>
								{{-- <input type="text" name="display" id="display" class="form-control"  required="" style="text-transform: uppercase;"> --}}
							</div>
							<div class="row">
								<label class="display-block text-semibold">Method Name</label>
								<input  type="text" name="method_name" id="method_name" class="form-control"  required="" style="text-transform: uppercase;" readonly>
							</div>

                            <div class="row">
								<label class="display-block text-semibold">Category</label>
                                <select name="category" id="category" class="form-control select">
                                    <option value="">== Select Category ==</option>
                                    @foreach ($categories as $id => $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
								{{-- <input  type="text" name="category" id="category" class="form-control"  required="" style="text-transform: uppercase;"> --}}
							</div>

                            <div class="row">
								<label class="display-block text-semibold">Category Spesimen</label>
                                <select name="category_specimen" id="category_specimen" class="form-control select">
                                    <option value="">== Select Category Specimen==</option>
                                </select>
								{{-- <input  type="text" name="category_specimen" id="category_specimen" class="form-control"  required="" style="text-transform: uppercase;"> --}}
							</div>

                            <div class="row">
								<label class="display-block text-semibold">Type Specimen</label>
                                <select name="type_specimen" id="type_specimen" class="form-control select">
                                    <option value="">== Select Type Specimen ==</option>
                                </select>
								{{-- <input  type="text" name="type_specimen" id="type_specimen" class="form-control"  required="" style="text-transform: uppercase;"> --}}
							</div>

                            <div class="row">
								<label class="display-block text-semibold">Komposisi Specimen</label>
								<input  type="text" name="komposisi_specimen" id="komposisi_specimen" class="form-control"  required="" style="text-transform: uppercase;">
							</div>

                            <div class="row">
								<label class="display-block text-semibold">Parameter</label>
								<input  type="text" name="parameter" id="parameter" class="form-control"  required="" style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Perlakuan Tes</label>
								<input  type="text" name="perlakuan_tes" id="perlakuan_tes" class="form-control"  required="" style="text-transform: uppercase;">
							</div>

                            <div class="row">
								<label class="display-block text-semibold">Operator</label>
                                <select name="operator" id="operator" class="form-control">
                                    <option value="">== Select Operator ==</option>
                                    @foreach ($operators as $id => $operator_name)
                                    <option value="{{ $id }}">{{ $operator_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          
						</div>
						<div class=col-lg-6>
                          

                            <div class="row">
								<label class="display-block text-semibold">Value 1</label>
								<input  type="text" name="value1" id="value1" class="form-control"  style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Value 2</label>
								<input  type="text" name="value2" id="value2" class="form-control"   style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Value 3</label>
								<input  type="text" name="value3" id="value3" class="form-control"   style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Value 4</label>
								<input  type="text" name="value4" id="value4" class="form-control"  style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Value 5</label>
								<input  type="text" name="value5" id="value5" class="form-control"   style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Value 6</label>
								<input  type="text" name="value6" id="value6" class="form-control"   style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Value 7</label>
								<input  type="text" name="value7" id="value7" class="form-control"  style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">UOM</label>
								<input  type="text" name="uom" id="uom" class="form-control"  style="text-transform: uppercase;">
							</div>
                            <div class="row">
								<label class="display-block text-semibold">Remarks</label>
								<input  type="text" name="remarks" id="remarks" class="form-control"  required="" style="text-transform: uppercase;">
							</div>
                        </div>
					
					</div>
					<div class="row"><br>
						<button class="btn btn-primary update" id="save" type="submit">Save</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">

$(function () {
    $('#method_code').on('change', function () {
        
        $.ajax({
                url: "{{ route('requirements.getMethods') }}?id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $.each(data, function(i)
                    {
                        document.getElementById("method_name").value = data[i].method_name;
                        // $('#method_name').html(data[i].method_name);
                    });
                    
                   
                }
            });
    });

    $('#category').on('change', function () {  
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        type: 'get',
	        url :  "{{ route('requirements.getCategories') }}",
	        data : {category:$('#category').val()},
	        // beforeSend:function(){
	        // 	loading();
	        // },
	        success: function(response) {
				console.log(response);
				var data = response.response;

	        	$('#category_specimen').empty();
				for (var i = 0; i < data.length; i++) {
				$('#category_specimen').append('<option value="'+data[i]['category_specimen']+'">'+data[i]['category_specimen']+'</option>')
				}
                // alert(notif.status,notif.output);
                // print(notif.idpr);
                // $.unblockUI();
                // $('#modal_daftar').modal('hide');
	         	
	        },
	        error: function(response) {
	           $.unblockUI();
		       alert(response.status,response.responseText);
	            
	        }
	    });

     
    });

	$('#category_specimen').on('change', function () {  
		
		
		console.log($('#category_specimen').val());
	    $.ajax({
	        type: 'get',
	        url :  "{{ route('requirements.getCategorySpecimen') }}",
	        data : {category_specimen:$('#category_specimen').val(), 
					category : $('#category').val()},
	        success: function(response) {
				console.log(response);
				var data = response.response;

	        	$('#type_specimen').empty();
				for (var i = 0; i < data.length; i++) {
				$('#type_specimen').append('<option value="'+data[i]['type_specimen']+'">'+data[i]['type_specimen']+'</option>')
				}
                // alert(notif.status,notif.output);
                // print(notif.idpr);
                // $.unblockUI();
                // $('#modal_daftar').modal('hide');
	         	
	        },
	        error: function(response) {
	           $.unblockUI();
		       alert(response.status,response.responseText);
	            
	        }
	    });

     
    });


	$('#form-create').submit(function(){
		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$.ajax({
	        type: 'POST',
	        url :  "{{ route('requirements.save') }}",
	        data : {
				requirement_id 		: $('#requirement_id').val(),
				method_code 		: $('#method_code').val(),
				category			: $('#category').val(),
				category_specimen	: $('#category_specimen').val(), 
				type_specimen	 	: $('#type_specimen').val(),
				komposisi_specimen	: $('#komposisi_specimen').val(),
				parameter			: $('#parameter').val(),
				perlakuan_tes		: $('#perlakuan_tes').val(),
				operator_id			: $('#operator').val(),
				value1				: $('#value1').val(),
				value2				: $('#value2').val(),
				value3				: $('#value3').val(),
				value4				: $('#value4').val(),
				value5				: $('#value5').val(),
				value6				: $('#value6').val(),
				value7				: $('#value7').val(),
				uom					: $('#uom').val(),
				remarks				: $('#remarks').val()
				},
	        success: function(response) {
				var data = response.response;
				// console.log(data);
				window.location.replace("{{ route('requirements.index') }}");
				
		
	         	
	        },
	        error: function(response) {
	           $.unblockUI();
		       alert(response.status,response.responseText);
	            
	        }
	    });
	});
});

</script>
@endsection