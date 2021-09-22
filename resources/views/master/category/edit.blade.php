@extends('layouts.app', ['active' => 'master_category'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
			<li class="active">Master Category</li>
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
				@foreach($category as $category)
				<form action="{{ route ('category.update')}}" id="form-update" method="POST">
					{{ csrf_field() }}

				
					<div class="row">
						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Category</label>
									<input type="hidden" name="id" id="id" value = "{{ $category->id}}"class="form-control">
							
									<input type="text" name="category" id="category" value = "{{ $category->category}}" class="form-control" placeholder="Input Method code ">
								</div>
							</div>
					
						</div>

						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Category Specimen</label>
									
									<input type="text" name="category_specimen" id="category_specimen" class="form-control" value = "{{ $category->category_specimen}}" placeholder="Input Method name ">
								</div>
							</div>		
					
						</div>

						
						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Type Specimen</label>
									
									<input type="text" name="type_specimen" id="type_specimen" class="form-control" value = "{{ $category->type_specimen}}" placeholder="Input Category">
								</div>
							</div>
					
					</div>
				
					<button type="submit" class="btn btn-blue-success col-xs-12" style="margin-top: 15px">Update <i class="icon-floppy-disk position-right"></i></button>

				</form>
				@endforeach
		
			</div>
		</div>
	</div>
</div>
@endsection




@section('js')
<script type="text/javascript">

</script>
@endsection