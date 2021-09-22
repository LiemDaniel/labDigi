@extends('layouts.app', ['active' => 'master_testing'])
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
				@foreach($testings as $testing)
				<form action="{{ route ('testing.update')}}" id="form-update" method="POST">
					{{ csrf_field() }}


					<div class="row">
						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Detail Testing Code</label>
									<input type="hidden" name="id" id="id" value = "{{ $testing->id}}"class="form-control">

									<input type="text" name="detail_testing_id" id="detail_testing_id" value = "{{ $testing->detail_testing_id}}" class="form-control" placeholder="Input Method code ">
								</div>
							</div>

						</div>

						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Testing Code</label>

									<input type="text" name="testing_code" id="testing_code" class="form-control" value = "{{ $testing->testing_code}}" placeholder="Input Method name ">
								</div>
							</div>

						</div>

						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Testing Name</label>

									<input type="text" name="testing_name" id="testing_name" class="form-control" value = "{{ $testing->testing_name}}" placeholder="Input Method name ">
								</div>
							</div>

						</div>


						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Method Code</label>

									<input type="text" name="method_code" id="method_code" class="form-control" value = "{{ $testing->method_code}}" placeholder="Input Category">
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Detail Testing 1</label>

									<input type="text" name="detail_testing_1" id="detail_testing_1" class="form-control" value = "{{ $testing->detail_testing_1}}" placeholder="Input Category">
								</div>
							</div>
						</div>


						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Detail Testing 2</label>

									<input type="text" name="detail_testing_2" id="detail_testing_2" class="form-control" value = "{{ $testing->detail_testing_2}}" placeholder="Input Category">
								</div>
							</div>
						</div>


						<div class="col-lg-12">
							<div class="col-md-12">
								<div class="row">
									<label class="display-block text-semibold">Keterangan</label>

									<input type="text" name="keterangan" id="keterangan" class="form-control" value = "{{ $testing->keterangan}}" placeholder="Input Category">
								</div>
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
