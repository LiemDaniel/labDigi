<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
    	return redirect()->route('home.index');
    }

    return redirect('/login');
});

Route::get('/auth', 'Auth\LoginController@showLogin')->name('auth.showLogin');
Route::post('/auth/loginaction', 'Auth\LoginController@loginAction')->name('auth.loginAction');
Route::post('/auth/logoutaction', 'Auth\LoginController@logoutAction')->name('auth.logoutAction');

Auth::routes();

Route::middleware('auth')->group(function(){
	Route::prefix('/dashboard')->group(function(){
		Route::get('', 'DashboardController@index')->name('home.index');
	});


	//account setting
	Route::prefix('/user')->group(function(){
		Route::get('/myAccount', 'User\AccountController@myAccount')->name('account.myAccount');
		Route::post('/myAccount/edit', 'User\AccountController@editPassword')->name('account.editPassword');
	});

	Route::prefix('/admin')->middleware(['permission:menu-user-management'])->group(function(){
		//user account
		Route::get('/user-account', 'Admin\AdminController@user_account')->name('admin.user_account');
		Route::get('/user-account/get-data', 'Admin\AdminController@getDataUser')->name('admin.getDataUser');
		Route::get('/user-account/ajaxGetRole', 'Admin\AdminController@ajaxGetRole')->name('admin.ajaxGetRole');
		Route::get('/user-account/add-user', 'Admin\AdminController@addUser')->name('admin.addUser');
		Route::get('/user-account/edit', 'Admin\AdminController@formEditUser')->name('admin.formEditUser');
		Route::get('/user-account/edit/edit-user', 'Admin\AdminController@editAccount')->name('admin.editAccount');
		Route::get('/user-account/edit/reset-password', 'Admin\AdminController@passwordReset')->name('admin.passwordReset');
		Route::get('/user-account/innactive', 'Admin\AdminController@innactiveUser')->name('admin.innactiveUser');
		Route::get('/user-account/factory', 'Admin\AdminController@getFactory')->name('admin.getFactory');

		//role
		Route::get('/role', 'Admin\AdminController@formRole')->name('admin.formRole');
		Route::get('/role/get-data', 'Admin\AdminController@ajaxRoleData')->name('admin.ajaxRoleData');
		Route::get('/role/new-role', 'Admin\AdminController@newRole')->name('admin.newRole');
		Route::post('/role/add-role', 'Admin\AdminController@addRole')->name('admin.addRole');
		Route::get('/role/edit', 'Admin\AdminController@editRoleUser')->name('admin.editRoleUser');
		Route::post('/role/update-role', 'Admin\AdminController@updateRole')->name('admin.updateRole');
	});

	//master
	Route::prefix('master')->group(function(){
		Route::prefix('master-method')->middleware(['permission:menu-master-method'])->group(function(){
			Route::get('', 'Master\MasterDataMethodController@index')->name('method.index');
			Route::get('export', 'Master\MasterDataMethodController@export')->name('method.export');
			Route::post('import', 'Master\MasterDataMethodController@import')->name('method.import');
			Route::get('data', 'Master\MasterDataMethodController@data')->name('method.data');
			Route::get('delete/{id}', 'Master\MasterDataMethodController@delete')->name('method.delete');
			Route::get('edit/{id}', 'Master\MasterDataMethodController@edit')->name('method.edit');
			Route::post('update', 'Master\MasterDataMethodController@update')->name('method.update');
		});

		Route::prefix('master-testing')->middleware(['permission:menu-master-testing'])->group(function(){
			Route::get('', 'Master\MasterDataTestingController@index')->name('testing.index');
			Route::get('export', 'Master\MasterDataTestingController@export')->name('testing.export');
			Route::post('import', 'Master\MasterDataTestingController@import')->name('testing.import');
			Route::get('data', 'Master\MasterDataTestingController@data')->name('testing.data');
			Route::get('delete/{id}', 'Master\MasterDataTestingController@delete')->name('testing.delete');
			Route::get('edit/{id}', 'Master\MasterDataTestingController@edit')->name('testing.edit');
			Route::post('update', 'Master\MasterDataTestingController@update')->name('testing.update');
		});

		Route::prefix('master-category')->middleware(['permission:menu-master-category'])->group(function(){
			Route::get('', 'Master\MasterDataCategoryController@index')->name('category.index');
			Route::get('export', 'Master\MasterDataCategoryController@export')->name('category.export');
			Route::post('import', 'Master\MasterDataCategoryController@import')->name('category.import');
			Route::get('data', 'Master\MasterDataCategoryController@data')->name('category.data');
			Route::get('delete/{id}', 'Master\MasterDataCategoryController@delete')->name('category.delete');
			Route::get('edit/{id}', 'Master\MasterDataCategoryController@edit')->name('category.edit');
			Route::post('update', 'Master\MasterDataCategoryController@update')->name('category.update');
		});

		Route::prefix('/master-requirements')->middleware(['permission:menu-master-requirements'])->group(function(){
			Route::get('', 'Master\MasterDataRequirementController@index')->name('requirements.index');
			Route::get('/create', 'Master\MasterDataRequirementController@create')->name('requirements.create');
			Route::get('/getMethods', 'Master\MasterDataRequirementController@getMethods')->name('requirements.getMethods');
			Route::get('/getCategories', 'Master\MasterDataRequirementController@getCategories')->name('requirements.getCategories');
			Route::get('/getCategorySpecimen', 'Master\MasterDataRequirementController@getCategorySpecimen')->name('requirements.getCategorySpecimen');
			Route::post('/save', 'Master\MasterDataRequirementController@save')->name('requirements.save');
			Route::get('data', 'Master\MasterDataRequirementController@data')->name('requirements.data');
			Route::get('delete/{id}', 'Master\MasterDataRequirementController@delete')->name('requirements.delete');
			Route::get('edit/{id}', 'Master\MasterDataRequirementController@edit')->name('requirements.edit');
			Route::post('update', 'Master\MasterDataRequirementController@update')->name('requirements.update');
		});




	});

	Route::prefix('trf')->group(function(){

        // TODO
		Route::prefix('/dashboard-trf')->middleware(['permission:menu-dashboard-trf'])->group(function(){
			Route::get('','Trf\DashboardTrfController@index')->name('dashboardTrf.index');
			Route::get('data', 'Trf\DashboardTrfController@data')->name('dashboardTrf.data');
			Route::get('approval/{id}', 'Trf\DashboardTrfController@approval')->name('dashboardTrf.approval');
			Route::get('reject/{id}', 'Trf\DashboardTrfController@reject')->name('dashboardTrf.reject');
			Route::get('index_verified','Trf\DashboardTrfController@index_verified')->name('dashboardTrf.index_verified');
			Route::get('data_verified', 'Trf\DashboardTrfController@data_verified')->name('dashboardTrf.data_verified');
			Route::get('detail/{id}', 'Trf\DashboardTrfController@detail')->name('dashboardTrf.detail');
			Route::post('update', 'Trf\DashboardTrfController@update')->name('dashboardTrf.update');
		});


	});






});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
