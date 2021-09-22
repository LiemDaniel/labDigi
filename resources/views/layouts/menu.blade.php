<ul class="navigation navigation-main navigation-accordion">
	
	<!-- Main -->
	@permission(['menu-dashboard'])
	<li class="{{ $active == 'dashboard' ? 'active' : ''}}"><a href="{{ route('home.index') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
	@endpermission

	@permission(['menu-user-management'])
	<li class="navigation-header"><span>User Management</span> <i class="icon-menu"></i></li>
	<li class="{{ $active == 'user_account' ? 'active' : ''}}"><a href="{{ route('admin.user_account')}}"><i class="icon-theater"></i> <span>User Account</span></a></li>
	<li class="{{ $active == 'role_user' ? 'active' : ''}}"><a href="{{route('admin.formRole')}}"><i class="icon-menu2"></i> <span>Role</span></a></li>
	@endpermission

	@permission(['menu-master'])
	<li class="navigation-header"><span>Master</span> <i class="icon-menu"></i></li>
	<li class="{{ $active == 'master_method' ? 'active' : ''}}"><a href="{{ route('method.index')}}"><i class="icon-theater"></i> <span>Master Method</span></a></li>
	<li class="{{ $active == 'master_testing' ? 'active' : ''}}"><a href="{{ route('testing.index')}}"><i class="icon-theater"></i> <span>Master Testing</span></a></li>
	<li class="{{ $active == 'master_category' ? 'active' : ''}}"><a href="{{ route('category.index')}}"><i class="icon-theater"></i> <span>Master Category</span></a></li>
	<li class="{{ $active == 'master_requirements' ? 'active' : ''}}"><a href="{{ route('requirements.index')}}"><i class="icon-theater"></i> <span>Master Requirements</span></a></li>

	@endpermission

	@permission(['menu-trf'])
	<li class="navigation-header"><span>TRF</span> <i class="icon-menu"></i></li>
	<li class="{{ $active == 'menu-dashboard-trf' ? 'active' : ''}}"><a href="{{ route('dashboardTrf.index')}}"><i class="icon-theater"></i> <span>Waiting List TRF</span></a></li>
	<li class="{{ $active == 'menu-trf-verified' ? 'active' : ''}}"><a href="{{ route('dashboardTrf.index')}}"><i class="icon-theater"></i> <span>Verified TRF</span></a></li>
	
	@endpermission

	

	<!-- /page kits -->

</ul>