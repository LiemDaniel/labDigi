@extends('layouts.app', ['active' => 'master_method'])
@section('header')
<div class="page-header page-header-default">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
			<li class="active"><a href="/master/master-method">Master Method</a></li>
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
				@foreach($methods as $method)
				<form action="{{ route ('method.update')}}" id="form-update" method="POST">
					{{ csrf_field() }}


					<div class="row">
						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Method Code</label>
									<input type="hidden" name="id" id="id" value = "{{ $method->id}}"class="form-control">

									<input type="text" name="method_code" id="method_code" value = "{{ $method->method_code}}" class="form-control" placeholder="Input Method code ">
								</div>
							</div>

						</div>

						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Method Name</label>

									<input type="text" name="method_name" id="method_name" class="form-control" value = "{{ $method->method_name}}" placeholder="Input Method name ">
								</div>
							</div>

						</div>


						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Category</label>

									<input type="text" name="category" id="category" class="form-control" value = "{{ $method->category}}" placeholder="Input Category">
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
