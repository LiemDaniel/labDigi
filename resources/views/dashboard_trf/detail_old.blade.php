@extends('layouts.app', ['active' => 'fabric_report_material_stock'])

@section('page-header')
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-grid5 position-left"></i> <span class="text-semibold">Master Data Fabric Testing</span></h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
			<ul class="breadcrumb">
				<li><a href="{{ route('home.index') }}"><i class="icon-home2 position-left"></i> Home</a></li>
				<li>Report</li>
				<li><a href="{{ route('dashboardTrf.index') }}">Master Data Fabric Testing</a></li>
				<li class="active">Detail</li>
			</ul>
            <ul class="breadcrumb-elements">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle legitRipple breadcrumb-dropdown" data-toggle="dropdown">
						<i class="icon-three-bars position-left"></i>
						Actions
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{ route('dashboardTrf.index', $master_data_fabric_testing->id) }}"><i class="icon-plus2 pull-right"></i> Create</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('page-content')
	<div class="panel panel-default border-grey">
		<div class="panel-heading">
			<h5 class="panel-title">Information<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12">
					<p>Testing Classification <b>{{ $master_data_fabric_testing->testing_classification}} </b></p>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<p>Method <b>{{ $master_data_fabric_testing->method }}</b></p>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<p>Testing Name <b> {{ $master_data_fabric_testing->testing_name }}</b></p>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default border-grey">
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table datatable-basic table-striped table-hover " id="detail_master_data_fabric_testing_table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Subtesting Name</th>
							<th>Require</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	{!! Form::hidden('master_data_fabric_testing_id',$master_data_fabric_testing->id, array('id' => 'master_data_fabric_testing_id')) !!}
@endsection

@section('page-js')
	{{-- <script src="{{ mix('js/detail_master_data_fabric_testing.js') }}"></script>
	<!-- <script type="text/javascript" src="{{ asset(elixir('js/detail_master_data_fabric_testing.js'))}}"></script> --> --}}
@endsection
