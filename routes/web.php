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
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['web']], function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/searchreport','HomeController@search_report')->name('searchreport');
Route::get('/shipment_detail/{record_id}','HomeController@shipment_detail')->name('shipment_detail');
Route::get('/exporter_detail/{id}','HomeController@exporter_detail')->name('exporter_detail');
Route::get('/importer_detail/{id}','HomeController@importer_detail')->name('importer_detail');
});
Route::group(['prefix' => 'lab'], function () {
	Route::group(['middleware' => ['labsuser']], function () {
       Route::get('dashboard', 'LabUser\DashboardController@index')->name('lab.dashboard');
         //lab exporters
       Route::get('exporters','LabUser\ExporterController@index')->name('lab.exporters');
	   Route::get('getaddexporters','LabUser\ExporterController@create')->name('lab.getaddexporters');
	   Route::post('saveexporter','LabUser\ExporterController@store')->name('lab.saveexporter');
	   Route::get('exporters/getedit/{id}','LabUser\ExporterController@edit')->name('lab.exporters.edit');
	   Route::post('exporters/update/{id}','LabUser\ExporterController@update')->name('lab.exporters.update');
	   Route::delete('exporters/{id}/delete','LabUser\ExporterController@destroy')->name('lab.exporters.delete');



	   // Lab Shipments 
	   Route::get('shipments','LabUser\ShipmentController@index')->name('lab.shipments');
	   Route::get('pending_shipments','LabUser\ShipmentController@pending_shipments')->name('lab.pending_shipments');
	   Route::get('failed_shipments','LabUser\ShipmentController@failed_shipments')->name('lab.failed_shipments');
	   Route::get('getaddshipment','LabUser\ShipmentController@create')->name('lab.getaddshipment');
	   Route::post('saveshipment','LabUser\ShipmentController@store')->name('lab.saveshipment');
	   Route::get('shipment/detail/{record_id}','LabUser\ShipmentController@show')->name('lab.shipment.show');
	   Route::get('shipment/view/{record_id}','LabUser\ShipmentController@shipment_detail')->name('lab.shipment_detail');
	   Route::get('shipments/get_step_two/{record_id}','LabUser\ShipmentController@get_step_two')->name('lab.shipment.get_step_two');
	   Route::get('shipments/get_step_three/{record_id}','LabUser\ShipmentController@get_step_three')->name('lab.shipment.get_step_three');
	   Route::post('shipment/search','LabUser\ShipmentController@searchShipments')->name('lab.shipment.search');
	   Route::post('shipments/step_two','LabUser\ShipmentController@step_two')->name('lab.shipment.step_two');
	   Route::post('shipments/step_three','LabUser\ShipmentController@step_three')->name('lab.shipment.step_three');
	   Route::get('exporter_detail/{id}','LabUser\ShipmentController@exporter_detail')->name('lab.exporter_detail');
	   Route::get('importer_detail/{id}','LabUser\ShipmentController@importer_detail')->name('lab.importer_detail');

     });
});
Route::group(['prefix' => 'customer'], function () {
	Route::get('signup', 'Customer\CustomerController@getSignup')->name('customer.register');
	Route::post('register', 'Customer\CustomerController@create')->name('customer.createcustomer');
	Route::group(['middleware' => ['customer']], function () {
		Route::get('dashboard', 'Customer\DashboardController@index')->name('customer.dashboard');
		Route::post('getexporters','Customer\DashboardController@getExporters')->name('customer.getexporters');
		Route::post('getdischargeports','Customer\DashboardController@getDischargePort')->name('customer.getdischargeports');
		Route::get('shipments','Customer\ShipmentController@index')->name('customer.shipments');
		
		Route::get('revisions','Customer\ShipmentController@revisions')->name('customer.revisions');
		Route::get('pending_shipments','Customer\ShipmentController@pending_shipments')->name('customer.pending_shipments');
		Route::get('failed_shipments','Customer\ShipmentController@failed_shipments')->name('customer.failed_shipments');
		Route::get('getaddshipment','Customer\ShipmentController@create')->name('customer.getaddshipment');
		Route::post('saveshipment','Customer\ShipmentController@store')->name('customer.saveshipment');
		
		Route::get('getpayments','Customer\ShipmentController@getshipment_payment')->name('customer.shipment.getpayments');
		Route::post('payments','Customer\ShipmentController@shipment_payment')->name('customer.shipment.payments');

		Route::get('shipment/detail/{record_id}','Customer\ShipmentController@show')->name('customer.shipment.show');
		Route::get('shipment/view/{record_id}','Customer\ShipmentController@shipment_detail')->name('customer.shipment_detail');
		Route::get('shipments/get_step_two/{record_id}','Customer\ShipmentController@get_step_two')->name('customer.shipment.get_step_two');
		Route::get('shipments/get_step_three/{record_id}','Customer\ShipmentController@get_step_three')->name('customer.shipment.get_step_three');
		Route::post('shipment/search','Customer\ShipmentController@searchShipments')->name('customer.shipment.search');
		Route::post('shipments/step_two','Customer\ShipmentController@step_two')->name('customer.shipment.step_two');
		Route::post('shipments/step_three','Customer\ShipmentController@step_three')->name('customer.shipment.step_three');
		Route::get('exporter_detail/{id}','Customer\ShipmentController@exporter_detail')->name('customer.exporter_detail');
		Route::get('importer_detail/{id}','Customer\ShipmentController@importer_detail')->name('customer.importer_detail');


		 // Exporters

		 Route::get('exporters','Customer\ExporterController@index')->name('customer.exporters');
		 Route::get('getaddexporters','Customer\ExporterController@create')->name('customer.getaddexporters');
		 Route::post('saveexporter','Customer\ExporterController@store')->name('customer.saveexporter');
		 Route::get('exporters/getedit/{id}','Customer\ExporterController@edit')->name('customer.exporters.edit');
		 Route::post('exporters/update/{id}','Customer\ExporterController@update')->name('customer.exporters.update');
		 Route::delete('exporters/{id}/delete','Customer\ExporterController@destroy')->name('customer.exporters.delete');
		Route::get('exporters/detail/{id}','Customer\ExporterController@show')->name('customer.exporters.detail');
	});
});


Route::group(['prefix' => 'admin'], function () {
   Route::get('login', 'Admin\AuthController@index')->name('admin');
   Route::post('login', 'Admin\AuthController@login')->name('admin.login');
   Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');

   Route::group(['middleware' => ['admins']], function () {
         Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

         // Admin Users
	   Route::get('adminusers','Admin\AdminUserController@index')->name('admin.adminusers');
	   Route::get('adduser','Admin\AdminUserController@create')->name('admin.adduser');
	   Route::get('getedit/{id}','Admin\AdminUserController@edit')->name('admin.adminusers.edit');
	   Route::post('update/{id}','Admin\AdminUserController@update')->name('admin.adminusers.update');
	   Route::post('saveuser','Admin\AdminUserController@store')->name('admin.saveuser');
	   Route::delete('adminusers/{id}/delete','Admin\AdminUserController@destroy')->name('admin.adminusers.delete');

	   // UAE users	    
	   Route::get('users','Admin\UsersController@index')->name('admin.users');
	   Route::get('getadd','Admin\UsersController@create')->name('admin.getadd');
	   Route::post('store','Admin\UsersController@store')->name('admin.storeuser');
	   Route::get('users/getedit/{id}','Admin\UsersController@edit')->name('admin.users.edit');
	   Route::post('users/update/{id}','Admin\UsersController@update')->name('admin.users.update');
	   Route::delete('users/{id}/delete','Admin\UsersController@destroy')->name('admin.users.delete');

	   // Importers
	   Route::get('importers','Admin\ImporterController@index')->name('admin.importers');
	   Route::get('getaddimporter','Admin\ImporterController@create')->name('admin.getaddimporter');
	   Route::post('saveimporter','Admin\ImporterController@store')->name('admin.saveimporter');
	   Route::get('importers/getedit/{id}','Admin\ImporterController@edit')->name('admin.importers.edit');
	   Route::post('importers/update/{id}','Admin\ImporterController@update')->name('admin.importers.update');
	   Route::delete('importers/{id}/delete','Admin\ImporterController@destroy')->name('admin.importers.delete');	  
	   Route::get('importer/detail/{id}','Admin\ImporterController@show')->name('admin.importer_detail');

	   // Exporters

	   Route::get('exporters','Admin\ExporterController@index')->name('admin.exporters');
	   Route::get('getaddexporters','Admin\ExporterController@create')->name('admin.getaddexporters');
	   Route::post('saveexporter','Admin\ExporterController@store')->name('admin.saveexporter');
	   Route::get('exporters/getedit/{id}','Admin\ExporterController@edit')->name('admin.exporters.edit');
	   Route::post('exporters/update/{id}','Admin\ExporterController@update')->name('admin.exporters.update');
	   Route::delete('exporters/{id}/delete','Admin\ExporterController@destroy')->name('admin.exporters.delete');
	  Route::get('exporters/detail/{id}','Admin\ExporterController@show')->name('admin.exporter_detail');

	   // Labs users	    
	   Route::get('labs','Admin\LabsController@index')->name('admin.labs');
	   Route::get('labs/getadd','Admin\LabsController@create')->name('admin.labs.getadd');
	   Route::post('labs/store','Admin\LabsController@store')->name('admin.labs.store');
	   Route::get('labs/getedit/{id}','Admin\LabsController@edit')->name('admin.labs.edit');
	   Route::post('labs/update/{id}','Admin\LabsController@update')->name('admin.labs.update');
	   Route::delete('labs/{id}/delete','Admin\LabsController@destroy')->name('admin.labs.delete');

	   // Register Location	    
	   Route::get('register_locations','Admin\RegistrationLocationController@index')->name('admin.register_locations');
	   Route::get('register_locations/getadd','Admin\RegistrationLocationController@create')->name('admin.register_locations.getadd');
	   Route::post('register_locations/store','Admin\RegistrationLocationController@store')->name('admin.register_locations.store');
	   Route::get('register_locations/getedit/{id}','Admin\RegistrationLocationController@edit')->name('admin.register_locations.edit');
	   Route::post('register_locations/update/{id}','Admin\RegistrationLocationController@update')->name('admin.register_locations.update');
	   Route::delete('register_locations/{id}/delete','Admin\RegistrationLocationController@destroy')->name('admin.register_locations.delete');

	   // Supervision Location	    
	   Route::get('supervision_locations','Admin\SupervisionLocationController@index')->name('admin.supervision_locations');
	   Route::get('supervision_locations/getadd','Admin\SupervisionLocationController@create')->name('admin.supervision_locations.getadd');
	   Route::post('supervision_locations/store','Admin\SupervisionLocationController@store')->name('admin.supervision_locations.store');
	   Route::get('supervision_locations/getedit/{id}','Admin\SupervisionLocationController@edit')->name('admin.supervision_locations.edit');
	   Route::post('supervision_locations/update/{id}','Admin\SupervisionLocationController@update')->name('admin.supervision_locations.update');
	   Route::delete('supervision_locations/{id}/delete','Admin\SupervisionLocationController@destroy')->name('admin.supervision_locations.delete');


	   // Office Location	    
	   Route::get('locations','Admin\LocationController@index')->name('admin.locations');
	   Route::get('locations/getadd','Admin\LocationController@create')->name('admin.locations.getadd');
	   Route::post('locations/store','Admin\LocationController@store')->name('admin.locations.store');
	   Route::get('locations/getedit/{id}','Admin\LocationController@edit')->name('admin.locations.edit');
	   Route::post('locations/update/{id}','Admin\LocationController@update')->name('admin.locations.update');
	   Route::delete('locations/{id}/delete','Admin\LocationController@destroy')->name('admin.locations.delete');


	   // Shipments 
	   Route::get('shipments','Admin\ShipmentController@index')->name('admin.shipments');	   
	   Route::get('pending_shipments','Admin\ShipmentController@pending_shipments')->name('admin.pending_shipments');
	   Route::get('failed_shipments','Admin\ShipmentController@failed_shipments')->name('admin.failed_shipments');
	   Route::get('getaddshipment','Admin\ShipmentController@create')->name('admin.getaddshipment');
	   Route::get('shipment/detail/{record_id}','Admin\ShipmentController@show')->name('admin.shipment.show');
	   Route::get('shipment/view/{record_id}','Admin\ShipmentController@shipment_detail')->name('admin.shipment_detail');
	 
	   Route::post('saveshipment','Admin\ShipmentController@store')->name('admin.saveshipment');
	   Route::get('shipments/get_step_two/{record_id}','Admin\ShipmentController@get_step_two')->name('admin.shipment.get_step_two');
	   Route::get('shipments/get_step_three/{record_id}','Admin\ShipmentController@get_step_three')->name('admin.shipment.get_step_three');
	   Route::post('shipments/step_two','Admin\ShipmentController@step_two')->name('admin.shipment.step_two');
	   Route::post('shipments/step_three','Admin\ShipmentController@step_three')->name('admin.shipment.step_three');
   });
});