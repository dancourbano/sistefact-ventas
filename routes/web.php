<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});


Auth::routes();

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', function () {
        return view('welcome');
    });
    Route::get('dashboard','DashboardController@index');
    Route::get('/', 'HomeController@index');
    //users
    Route::get('users', 'UsersController@index');
    Route::get('users/edit/{id}', 'UsersController@edit');
    Route::get('users/delete/{id}', 'UsersController@destroy');
    Route::get('users/create', 'UsersController@create');
    Route::post('users/update', 'UsersController@update');
    Route::post('users/sendUsers/{action}', array('uses' => 'UsersController@sendDataUsers'));
    //customers
    Route::get('admin/customer', array('uses' => 'CustomerController@index','as' => 'customer.index'));

    Route::get('customer/filter-all', array('uses' => 'CustomerController@getFilterAllCustomer'));
    Route::get('customer/searchCustomer/{customerId}', array('uses' => 'CustomerController@getCustomer'));
    Route::get('customer/showCustomer/{action}/{customerId}', array('uses' => 'CustomerController@showCustomer'));
    Route::post('customer/sendCustomer/{action}', array('uses' => 'CustomerController@sendDataCustomer'));
    Route::get('customer/deleteCustomer/{customerId}', array('uses' => 'CustomerController@deleteCustomer'));
    Route::get('customer/showVehicles/{customerId}', array('uses' => 'CustomerController@showVehicles'));
    Route::get('customer/create', array('uses' => 'CustomerController@create'));
    Route::get('customer', array('uses' => 'CustomerController@index'));
    Route::get('customer/filterCustomerPerMonth/{year}', array('uses' => 'CustomerController@getFilterCustomerPerMonth'));

//vehicle
    Route::get('vehicle', array('uses' => 'VehicleController@index'));
    Route::get('vehicle/showHistory', array('uses' => 'VehicleController@showHistory'));
    Route::post('vehicle/sendVehicle/{action}/{vehicleId}', array('uses' => 'VehicleController@sendDataVehicle'));
    Route::get('vehicle/showVehicle/{action}/{vehicleId}', array('uses' => 'VehicleController@showVehicle'));
    Route::get('vehicle/deleteVehicle/{vehicleId}', array('uses' => 'VehicleController@deleteVehicle'));
    Route::get('vehicle/create', array('uses' => 'VehicleController@create'));
    Route::get('vehicle/callVehicles/{customerId}', array('uses' => 'VehicleController@getVehiclesOfCustomer'));
    Route::post('vehicle/getEmergencyContacts/{vehicleId}', 'VehicleController@getEmergencyContacts');

// Items
    Route::post('item/getItems', 'ItemController@getItems');
    Route::get('item/getIfItemIsUsed/{itemId}', 'ItemController@getIfItemIsUsed');

// Productos
    Route::get('product', 'ProductController@index');
    Route::get('product/action/{action}/{productId}', 'ProductController@action');
    Route::get('product/delete/{productId}', 'ProductController@delete');
    Route::get('product/showHistory', 'ProductController@showHistory');
    Route::post('product/sendDataProduct/{action}/{productId}','ProductController@sendDataProduct');

// Servicios
    Route::get('service', 'ServiceController@index');
    Route::get('service/create', 'ServiceController@create');
    Route::get('service/edit/{serviceId}', 'ServiceController@edit');
    Route::get('service/delete/{serviceId}', 'ServiceController@delete');
    Route::post('service/sendDataService/{action}', 'ServiceController@sendDataService');

//Package
    Route::get('package', 'PackageController@index');
    Route::get('package/create', 'PackageController@create');
    Route::get('package/edit/{packageId}', 'PackageController@edit');
    Route::get('package/delete/{packageId}', 'PackageController@delete');
    Route::post('package/sendDataPackage/{action}', 'PackageController@sendDataPackage');
    Route::post('package/getDetailPackage/{packageId}', 'PackageController@getDetailPackage');
    Route::get('package/getAllDetailPackages', 'PackageController@getAllDetailPackages');
    Route::get('package/getIfPackageIsUsed/{packageId}', 'PackageController@getIfPackageIsUsed');

//Driver
    Route::get('driver','DriverController@index');
    Route::get('driver/showDriver/{action}/{driverId}', array('uses' => 'DriverController@showDriver'));
    Route::get('driver/deleteDriver/{driverId}', array('uses' => 'DriverController@delete'));
    Route::post('driver/sendDriver/{action}/{driverId}', array('uses' => 'DriverController@sendDataDriver'));
    Route::get('driver/delete/{driverId}', 'DriverController@delete');

//Invoice
    Route::get('invoice','InvoiceController@index');
    Route::get('invoice/showInvoice/{action}/{invoiceId}','InvoiceController@showInvoice');
    Route::post('invoice/sendDataInvoice/{action}',array('uses'=>'InvoiceController@sendDataInvoice'));
    Route::get('invoice/print/{invoiceId}', array('uses' => 'InvoiceController@printInvoice'));
    Route::get('invoice/pdf/{invoiceId}', array('uses' => 'InvoiceController@pdfInvoice'));
    Route::get('invoice/excel/{invoiceId}', array('uses' => 'InvoiceController@excelInvoice'));
    Route::get('invoice/email/{invoiceId}/{customerId}', array('uses' => 'InvoiceController@emailInvoice'));
    Route::get('invoice/delete/{invoiceId}', array('uses' => 'InvoiceController@deleteInvoice'));
    Route::get('invoice/getInvoice/{invoiceId}', array('uses' => 'InvoiceController@getInvoice'));
    Route::get('invoice/filterInvoice', array('uses' => 'InvoiceController@filterInvoice'));
    Route::get('invoice/generate', array('uses' => 'InvoiceController@generateInvoice'));//ruta solo para pruebas
    Route::get('invoice/vistaEmail/{invoiceId}', array('uses' => 'InvoiceController@viewEmail'));//ruta solo para ver la vista de email


//Movement
    Route::get('movement','MovementController@index');
    Route::get('movement/create', 'MovementController@create');
    Route::get('movement/edit/{movementId}', 'MovementController@edit');
    Route::get('movement/delete/{movementId}', 'MovementController@delete');
    Route::post('movement/sendDataMovement/{action}', 'MovementController@sendDataMovement');
    Route::get('movement/callData', 'MovementController@callData');
Route::get('movement/filterMovement',array('uses'=>'MovementController@filterMovement'));

Route::get('payment/existPayment/{invoiceId}', 'PaymentController@existPayment');

    Route::get('payment','PaymentController@index');
    Route::get('payment/{invoiceId}','PaymentController@getPayments');
    Route::get('payment/create/{invoiceId}', 'PaymentController@create');
    Route::get('payment/edit/{movementId}', 'PaymentController@edit');
    Route::get('payment/delete/{movementId}', 'PaymentController@delete');
    Route::post('payment/sendDataPayment/{action}', 'PaymentController@sendDataPayment');

    Route::get('maintenance','MaintenanceController@index');
    Route::get('maintenance/{vehicleId}','MaintenanceController@getMaintenances');
    Route::get('maintenance/create/{vehicleId}','MaintenanceController@create');
    Route::get('maintenance/edit/{maintenanceId}','MaintenanceController@edit');
    Route::get('maintenance/delete/{maintenanceId}','MaintenanceController@delete');
    Route::post('maintenance/sendDataMaintenance/{action}','MaintenanceController@sendDataMaintenance');
    Route::post('maintenance/filterMaintenance1',array('uses' => 'MaintenanceController@filterMaintenance1'));

//Detail Maintenance
Route::get('detailMaintenance/{vehicleId}','DetailMaintenanceController@getDetailMaintenance');
Route::get('detailMaintenance/edit/{maintenanceId}','DetailMaintenanceController@edit');
Route::post('detailMaintenance/sendDataDetailMaintenance/{action}','DetailMaintenanceController@sendDataDetailMaintenance');


//Report Profit
    Route::get('profit',array('uses'=>'ReportProfitController@index'));
    Route::get('profit/filterProfit',array('uses'=>'ReportProfitController@filterProfit'));

//Report Invoicing
    Route::get('invoicing',array('uses'=>'ReportInvoicingController@index'));
    Route::get('invoicing/filterInvoicing',array('uses'=>'ReportInvoicingController@filterInvoicing'));
    Route::get('invoicing/print/{startEmission}/{endEmission}/{customerId}/{status}',array('uses'=>'ReportInvoicingController@printInvoicing'));
    Route::get('invoicing/pdf/{startEmission}/{endEmission}/{customerId}/{status}',array('uses'=>'ReportInvoicingController@pdfInvoicing'));
    Route::get('invoicing/excel/{startEmission}/{endEmission}/{customerId}/{status}',array('uses'=>'ReportInvoicingController@excelInvoicing'));
    Route::get('invoicing/getInvoiceForDashboard/{year}/{month}', array('uses' => 'InvoiceController@getInvoiceForDashboard'));
//Report Movements

    Route::get('report/movements',array('uses'=>'ReportMovementsController@index'));
    Route::get('report/movements/getReportOfThisMonth',array('uses' => 'ReportMovementsController@getReportOfThisMonth'));

    
    //Send SMS

    Route::get('smsSend/movements',array('uses'=>'SmsSendController@index'));
    Route::get('smsSend/showVehicle/{action}/{vehicleId}', array('uses' => 'SmsSendController@showVehicle'));
    Route::post('smsSend/sendVehicle/{action}/{vehicleId}', array('uses' => 'SmsSendController@sendDataVehicle'));
    Route::get('smsSend/deleteVehicle/{vehicleId}', array('uses' => 'SmsSendController@deleteVehicle'));
    Route::get('smsSend/send/', array('uses' => 'SmsSendController@sendCommandSms'));
    Route::get('smsSend/type', array('uses' => 'SmsSendController@typeSMS'));
    Route::get('smsSend/type/{action}/{typeCommandSmsId}', array('uses' => 'SmsSendController@typeSMSCreateEdit'));
    Route::get('smsSend/getCommandSms/{typeCommandSmsId}', 'SmsSendController@getCommandSms');
    Route::post('smsSend/sendTypeCommand/{action}/{typeCommandSmsId}', array('uses' =>'SmsSendController@sendDataTypeCommand'));
});

Route::group(['middleware' => ['cobranza'],'prefix'=>'cobranza' ,'as' => 'cobranza.'], function () {
    Route::get('/admin', function () {
        return view('welcome');
    });
    Route::get('dashboard','DashboardController@index');
    Route::get('/', 'HomeController@index');
    //users

    //customers
    Route::get('admin/customer', array('uses' => 'CustomerController@index','as' => 'customer.index'));

    Route::get('customer/filter-all', array('uses' => 'CustomerController@getFilterAllCustomer'));
    Route::get('customer/searchCustomer/{customerId}', array('uses' => 'CustomerController@getCustomer'));
    Route::get('customer/showCustomer/{action}/{customerId}', array('uses' => 'CustomerController@showCustomer'));
    Route::post('customer/sendCustomer/{action}', array('uses' => 'CustomerController@sendDataCustomer'));
    Route::get('customer/deleteCustomer/{customerId}', array('uses' => 'CustomerController@deleteCustomer'));
    Route::get('customer/create', array('uses' => 'CustomerController@create'));
    Route::get('customer', array('uses' => 'CustomerController@index'));
    Route::get('customer/filterCustomerPerMonth/{year}', array('uses' => 'CustomerController@getFilterCustomerPerMonth'));
    Route::get('customer/showVehicles/{customerId}', array('uses' => 'CustomerController@showVehicles'));

//vehicle
    Route::get('vehicle', array('uses' => 'VehicleController@index'));
    Route::post('vehicle/sendVehicle/{action}/{vehicleId}', array('uses' => 'VehicleController@sendDataVehicle'));
    Route::get('vehicle/showVehicle/{action}/{vehicleId}', array('uses' => 'VehicleController@showVehicle'));
    Route::get('vehicle/deleteVehicle/{vehicleId}', array('uses' => 'VehicleController@deleteVehicle'));
    Route::get('vehicle/create', array('uses' => 'VehicleController@create'));
    Route::get('vehicle/callVehicles/{customerId}', array('uses' => 'VehicleController@getVehiclesOfCustomer'));
    Route::get('vehicle/showHistory', array('uses' => 'VehicleController@showHistory'));
    Route::post('vehicle/getEmergencyContacts/{vehicleId}', 'VehicleController@getEmergencyContacts');

// Items
    Route::post('item/getItems', 'ItemController@getItems');
    Route::get('item/getIfItemIsUsed/{itemId}', 'ItemController@getIfItemIsUsed');

// Productos
    Route::get('product', 'ProductController@index');
    Route::get('product/action/{action}/{productId}', 'ProductController@action');
    Route::get('product/delete/{productId}', 'ProductController@delete');
    Route::post('product/sendDataProduct/{action}/{productId}','ProductController@sendDataProduct');
    Route::get('product/showHistory', 'ProductController@showHistory');
// Servicios
    Route::get('service', 'ServiceController@index');
    Route::get('service/create', 'ServiceController@create');
    Route::get('service/edit/{serviceId}', 'ServiceController@edit');
    Route::get('service/delete/{serviceId}', 'ServiceController@delete');
    Route::post('service/sendDataService/{action}', 'ServiceController@sendDataService');

//Package
    Route::get('package', 'PackageController@index');
    Route::get('package/create', 'PackageController@create');
    Route::get('package/edit/{packageId}', 'PackageController@edit');
    Route::get('package/delete/{packageId}', 'PackageController@delete');
    Route::post('package/sendDataPackage/{action}', 'PackageController@sendDataPackage');
    Route::post('package/getDetailPackage/{packageId}', 'PackageController@getDetailPackage');
    Route::get('package/getAllDetailPackages', 'PackageController@getAllDetailPackages');
    Route::get('package/getIfPackageIsUsed/{packageId}', 'PackageController@getIfPackageIsUsed');

//Driver
    Route::get('driver','DriverController@index');
    Route::get('driver/showDriver/{action}/{driverId}', array('uses' => 'DriverController@showDriver'));
    Route::get('driver/deleteDriver/{driverId}', array('uses' => 'DriverController@delete'));
    Route::post('driver/sendDriver/{action}/{driverId}', array('uses' => 'DriverController@sendDataDriver'));
    Route::get('driver/delete/{driverId}', 'DriverController@delete');

//Invoice
    Route::get('invoice','InvoiceController@index');
    Route::get('invoice/showInvoice/{action}/{invoiceId}','InvoiceController@showInvoice');
    Route::post('invoice/sendDataInvoice/{action}',array('uses'=>'InvoiceController@sendDataInvoice'));
    Route::get('invoice/print/{invoiceId}', array('uses' => 'InvoiceController@printInvoice'));
    Route::get('invoice/pdf/{invoiceId}', array('uses' => 'InvoiceController@pdfInvoice'));
    Route::get('invoice/excel/{invoiceId}', array('uses' => 'InvoiceController@excelInvoice'));
    Route::get('invoice/email/{invoiceId}/{customerId}', array('uses' => 'InvoiceController@emailInvoice'));
    Route::get('invoice/delete/{invoiceId}', array('uses' => 'InvoiceController@deleteInvoice'));
    Route::get('invoice/getInvoice/{invoiceId}', array('uses' => 'InvoiceController@getInvoice'));
    Route::get('invoice/filterInvoice', array('uses' => 'InvoiceController@filterInvoice'));


//Movement
    Route::get('movement','MovementController@index');
    Route::get('movement/create', 'MovementController@create');
    Route::get('movement/edit/{movementId}', 'MovementController@edit');
    Route::get('movement/delete/{movementId}', 'MovementController@delete');
    Route::post('movement/sendDataMovement/{action}', 'MovementController@sendDataMovement');
    Route::get('movement/callData', 'MovementController@callData');

    Route::get('payment/existPayment/{invoiceId}', 'PaymentController@existPayment');




    Route::get('payment','PaymentController@index');
    Route::get('payment/{invoiceId}','PaymentController@getPayments');
    Route::get('payment/create/{invoiceId}', 'PaymentController@create');
    Route::get('payment/edit/{paymentId}', 'PaymentController@edit');
    Route::get('payment/delete/{paymentId}', 'PaymentController@delete');
    Route::post('payment/sendDataPayment/{action}', 'PaymentController@sendDataPayment');

    Route::get('maintenance','MaintenanceController@index');
    Route::get('maintenance/{vehicleId}','MaintenanceController@getMaintenances');
    Route::get('maintenance/create/{vehicleId}','MaintenanceController@create');
    Route::get('maintenance/edit/{maintenanceId}','MaintenanceController@edit');
    Route::get('maintenance/delete/{maintenanceId}','MaintenanceController@delete');
    Route::post('maintenance/sendDataMaintenance/{action}','MaintenanceController@sendDataMaintenance');
    Route::post('maintenance/filterMaintenance1',array('uses' => 'MaintenanceController@filterMaintenance1'));


//Detail Maintenance
    Route::get('detailMaintenance/{vehicleId}','DetailMaintenanceController@getDetailMaintenance');
    Route::get('detailMaintenance/edit/{detailMaintenanceId}','DetailMaintenanceController@edit');
    Route::post('detailMaintenance/sendDataDetailMaintenance/{action}','DetailMaintenanceController@sendDataDetailMaintenance');


//Report Profit
    Route::get('profit',array('uses'=>'ReportProfitController@index'));
    Route::get('profit/filterProfit',array('uses'=>'ReportProfitController@filterProfit'));

//Report Invoicing
    Route::get('invoicing',array('uses'=>'ReportInvoicingController@index'));
    Route::get('invoicing/filterInvoicing',array('uses'=>'ReportInvoicingController@filterInvoicing'));
    Route::get('invoicing/print/{startEmission}/{endEmission}/{customerId}/{status}',array('uses'=>'ReportInvoicingController@printInvoicing'));
    Route::get('invoicing/pdf/{startEmission}/{endEmission}/{customerId}/{status}',array('uses'=>'ReportInvoicingController@pdfInvoicing'));
    Route::get('invoicing/excel/{startEmission}/{endEmission}/{customerId}/{status}',array('uses'=>'ReportInvoicingController@excelInvoicing'));
    Route::get('invoicing/getInvoiceForDashboard/{year}/{month}', array('uses' => 'InvoiceController@getInvoiceForDashboard'));
//Report Movements

    Route::get('report/movements',array('uses'=>'ReportMovementsController@index'));
    Route::get('report/movements/getReportOfThisMonth',array('uses' => 'ReportMovementsController@getReportOfThisMonth'));

    //Send SMS
    Route::get('smsSend/movements',array('uses'=>'SmsSendController@index'));
    Route::get('smsSend/showVehicle/{action}/{vehicleId}', array('uses' => 'SmsSendController@showVehicle'));
    Route::post('smsSend/sendVehicle/{action}/{vehicleId}', array('uses' => 'SmsSendController@sendDataVehicle'));
    Route::get('smsSend/deleteVehicle/{vehicleId}', array('uses' => 'SmsSendController@deleteVehicle'));
    Route::get('smsSend/send/', array('uses' => 'SmsSendController@sendCommandSms'));
    Route::get('smsSend/type', array('uses' => 'SmsSendController@typeSMS'));
    Route::get('smsSend/type/{action}/{typeCommandSmsId}', array('uses' => 'SmsSendController@typeSMSCreateEdit'));
    Route::get('smsSend/getCommandSms/{typeCommandSmsId}', 'SmsSendController@getCommandSms');
    Route::post('smsSend/sendTypeCommand/{action}/{typeCommandSmsId}', array('uses' =>'SmsSendController@sendDataTypeCommand'));
});



Route::group(['middleware' =>['monitor'],'prefix'=>'monitor' ,'as' => 'monitor.'], function () {
    Route::get('/admin', function () {
        return view('welcome');
    });
    Route::get('dashboard',array('uses'=>'DashboardController@index'));

    Route::get('/', 'HomeController@index');
    //vehicle
    Route::get('vehicle', array('uses' => 'VehicleController@index'));
    Route::post('vehicle/sendVehicle/{action}/{vehicleId}', array('uses' => 'VehicleController@sendDataVehicle'));
    Route::get('vehicle/showVehicle/{action}/{vehicleId}', array('uses' => 'VehicleController@showVehicle'));
    Route::get('vehicle/showContact/{vehicleId}', array('uses' => 'VehicleController@showContact'));
    Route::get('vehicle/deleteVehicle/{vehicleId}', array('uses' => 'VehicleController@deleteVehicle'));
    Route::get('vehicle/create', array('uses' => 'VehicleController@create'));
    Route::get('vehicle/showHistory', array('uses' => 'VehicleController@showHistory'));
    Route::post('vehicle/getEmergencyContacts/{vehicleId}', 'VehicleController@getEmergencyContacts');


    //customers
    Route::get('customer', ['uses' => 'CustomerController@index','as' => 'customer']);
    Route::get('customer/filter-all', array('uses' => 'CustomerController@getFilterAllCustomer'));
    Route::get('customer/searchCustomer/{customerId}', array('uses' => 'CustomerController@getCustomer'));
    Route::get('customer/showCustomer/{action}/{customerId}', array('uses' => 'CustomerController@showCustomer'));
    Route::post('customer/sendCustomer/{action}', array('uses' => 'CustomerController@sendDataCustomer'));
    Route::get('customer/deleteCustomer/{customerId}', array('uses' => 'CustomerController@deleteCustomer'));
    Route::get('customer/create', array('uses' => 'CustomerController@create'));
    Route::get('customer', array('uses' => 'CustomerController@index'));
    Route::get('customer/filterCustomerPerMonth/{year}', array('uses' => 'CustomerController@getFilterCustomerPerMonth'));
    Route::get('customer/showVehicles/{customerId}', array('uses' => 'CustomerController@showVehicles'));


    //Detail Maintenance
    Route::get('detailMaintenance/{vehicleId}','DetailMaintenanceController@getDetailMaintenance');
    Route::get('detailMaintenance/edit/{maintenanceId}','DetailMaintenanceController@edit');
    Route::post('detailMaintenance/sendDataDetailMaintenance/{action}','DetailMaintenanceController@sendDataDetailMaintenance');

    //Maintenance
    Route::get('maintenance','MaintenanceController@index');
    Route::get('maintenance/{vehicleId}','MaintenanceController@getMaintenances');
    Route::get('maintenance/create/{vehicleId}','MaintenanceController@create');
    Route::get('maintenance/edit/{maintenanceId}','MaintenanceController@edit');
    Route::get('maintenance/delete/{maintenanceId}','MaintenanceController@delete');
    Route::post('maintenance/sendDataMaintenance/{action}','MaintenanceController@sendDataMaintenance');
    Route::post('maintenance/filterMaintenance1', array('uses' => 'MaintenanceController@filterMaintenance1'));

    //Driver
    Route::get('driver','DriverController@index');
    Route::get('driver/showDriver/{action}/{driverId}', array('uses' => 'DriverController@showDriver'));
    Route::get('driver/deleteDriver/{driverId}', array('uses' => 'DriverController@delete'));
    Route::post('driver/sendDriver/{action}/{driverId}', array('uses' => 'DriverController@sendDataDriver'));
    Route::get('driver/delete/{driverId}', 'DriverController@delete');






});






