<?php

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Company\CompanyRegistrationController;
use App\Http\Controllers\Company\CompanyRegistrationSupplierController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DSTV\DSTVPackageController;
use App\Http\Controllers\DSTV\DSTVPaymentController;
use App\Http\Controllers\DSTV\DSTVTransactionController;
use App\Http\Controllers\Ecocash\EcocashAgentLineController;
use App\Http\Controllers\Ecocash\EcocashController;
use App\Http\Controllers\Ecocash\EcocashTransactionTypeController;
use App\Http\Controllers\EggsController;
use App\Http\Controllers\GeneralSales\GeneralSalesController;
use App\Http\Controllers\GeneralSales\GeneralSaleTransactionTypeController;
use App\Http\Controllers\Insurance\InsuranceBrokerController;
use App\Http\Controllers\Insurance\InsurancePaymentController;
use App\Http\Controllers\Insurance\InsuranceTransactionController;
use App\Http\Controllers\Loan\LoanDisbursedController;
use App\Http\Controllers\Loan\LoanPaymentController;
use App\Http\Controllers\Notes\NotesController;
use App\Http\Controllers\PermanentDiscController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Reports\DSTVReportController;
use App\Http\Controllers\RTGS\RTGsController;
use App\Http\Controllers\RTGS\RTGSTransactionTypeController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\Summary\SummaryController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Vehicle\VehicleClassController;
use App\Http\Controllers\Zinara\ZinaraTransactionController;
use App\Http\Controllers\Zinara\ZinaraTransactionTypeController;
use App\Http\Livewire\EditGeneralSale;
use Illuminate\Support\Facades\Route;

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


Route::get('/dstv', [DSTVTransactionController::class, "view"])->name("view_dstv");


Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
    return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');


/*
 * WEB
 */

//REPORTS
Route::get("report/dstv", [DSTVReportController::class, "view"])->name("report_dstv");
Route::get("report/insurance", [\App\Http\Controllers\Reports\InsuranceReportController::class, "view"])->name("report_insurance");

Route::get("notes", [NotesController::class, "view"])->name("notes");
Route::get("notes/add", [NotesController::class, "add"])->name("notes_add");

Route::get("user", [UsersController::class, "view"])->name("user");
Route::get("user/add", [UsersController::class, "add"])->name("user_add");

Route::get("client", [ClientController::class, "view"])->name("client");
Route::get("client/add", [ClientController::class, "add"])->name("client_add");

Route::get("dstv", [DSTVTransactionController::class, "view"])->name("dstv");
Route::get("dstv/add", [DSTVTransactionController::class, "add"])->name("dstv_subscription_add");
Route::get("dstv/package", [DSTVPackageController::class, "view"])->name("dstv_package");
Route::get("dstv/package/add", [DSTVPackageController::class, "add"])->name("dstv_package_add");

Route::get("loan", [LoanDisbursedController::class, "view"])->name("loan_disbursed");
Route::get("loan/add", [LoanDisbursedController::class, "add"])->name("loan_disbursed_add");

Route::get("insurance", [InsuranceTransactionController::class, "view"])->name("insurance");
Route::get("insurance/add", [InsuranceTransactionController::class, "add"])->name("insurance_payment_add");

Route::get("insurance/broker", [InsuranceBrokerController::class, "view"])->name("insurance_broker");
Route::get("insurance/broker/add", [InsuranceBrokerController::class, "add"])->name("insurance_broker_add");

Route::get("currency", [CurrencyController::class, "view"])->name("currency");
Route::get("currency/add", [CurrencyController::class, "add"])->name("currency_add");

Route::get("vehicle/class", [VehicleClassController::class, "view"])->name("vehicle_class");
Route::get("vehicle/class/add", [VehicleClassController::class, "add"])->name("vehicle_class_add");

Route::get("ecocash/transaction_type", [EcocashTransactionTypeController::class, "view"])->name("ecocash_transaction_type");
Route::get("ecocash/transaction_type/add", [EcocashTransactionTypeController::class, "add"])->name("ecocash_transaction_type_add");

Route::get(
	"ecocash",
	[
		EcocashController::class,
		"view"
	]
)->name( "ecocash" );
Route::get(
	"ecocash/add",
	[
		EcocashController::class,
		"add"
	]
)->name( "ecocash_add" );

Route::get(
	"ecocash/agent/line",
	[
		EcocashAgentLineController::class,
		"view"
	]
)->name( "ecocash_agent_line" );
Route::get(
	"ecocash/agent/line/add",
	[
		EcocashAgentLineController::class,
		"add"
	]
)->name( "ecocash_agent_line_add" );

Route::get(
	"company/registration",
	[
		CompanyRegistrationController::class,
		"view"
	]
)->name( "company_registration" );
Route::get(
	"company/registration/add",
	[
		CompanyRegistrationController::class,
		"add"
	]
)->name( "company_registration_add" );

Route::get(
	"company/registration/supplier",
	[
		CompanyRegistrationSupplierController::class,
		"view"
	]
)->name( "company_registration_supplier" );
Route::get(
	"company/registration/supplier/add",
	[
		CompanyRegistrationSupplierController::class,
		"add"
	]
)->name( "company_registration_supplier_add" );

Route::get(
	"permanent/disc",
	[
		PermanentDiscController::class,
		"view"
	]
)->name( "permanent_disc" );
Route::get(
	"permanent/disc/add",
	[
		PermanentDiscController::class,
		"add"
	]
)->name( "permanent_disc_add" );

Route::get(
	"eggs",
	[
		EggsController::class,
		"view"
	]
)->name( "eggs" );
Route::get(
	"eggs/add",
	[
		EggsController::class,
		"add"
	]
)->name( "eggs_add" );

Route::get(
	"rtgs",
	[
		RTGsController::class,
		"view"
	]
)->name( "rtgs" );
Route::get(
	"rtgs/add",
	[
		RTGsController::class,
		"add"
	]
)->name( "rtgs_add" );

Route::get(
	'agent',
	[
		AgentController::class,
		'view'
	]
)->name( 'agent' );
Route::get(
	'agent/add',
	[
		AgentController::class,
		'add'
	]
)->name( 'agent_add' );

Route::get(
	'agent/edit/{id}',
	[
		AgentController::class,
		'agent_edit'
	]
)->name( 'agent_edit' );
Route::get(
	'agent/view/{id}',
	[
		AgentController::class,
		'view_agent'
	]
)->name( 'agent_view' );
Route::delete(
	'agent/delete/{id}',
	[
		AgentController::class,
		'delete'
	]
)->name( 'agent_delete' );

/*
 * API
 */

Route::post(
	'api/rtgs/new',
	[
		RTGsController::class,
		"create_rtgs"
	]
)->name( "api_create_rtgs" );
Route::post(
	'api/rtgs/{id}',
	[
		RTGsController::class,
		"update_rtgs"
	]
)->name( "api_update_rtgs" );
Route::get(
	'api/rtgs',
	[
		RTGsController::class,
		"list_rtgs"
	]
)->name( "api_get_rtgs" );
Route::get(
	'api/rtgs/user/{user_id}',
	[
		RTGsController::class,
		"list_rtgs_by_user"
	]
)->name( "api_get_rtgs_by_user" );
Route::delete(
	'api/rtgs/{id}',
	[
		RTGsController::class,
		"delete_rtgs"
	]
)->name( "api_delete_rtgs" );
Route::get(
	'/api/rtgs/edit/{id}',
	[
		RTGsController::class,
		"edit_rtgs"
	]
)->name( "api_edit_rtgs" );
Route::get(
	'/api/rtgs/view/{id}',
	[
		RTGsController::class,
		"view_rtgs"
	]
)->name( "api_view_rtgs" );

Route::post(
	'api/permanent/disc/new',
	[
		PermanentDiscController::class,
		"create_permanent_disc"
	]
)->name( "api_create_permanent_disc" );
Route::post(
	'api/permanent/disc',
	[
		PermanentDiscController::class,
		"update_permanent_disc"
	]
)->name( "api_update_permanent_disc" );
Route::get(
	'api/permanent/disc',
	[
		PermanentDiscController::class,
		"list_permanent_disc"
	]
)->name( "api_get_permanent_disc" );
Route::delete(
	'api/permanent/disc/{id}',
	[
		PermanentDiscController::class,
		"delete_permanent_disc"
	]
)->name( "api_delete_permanent_disc" );
Route::get(
	'/permanent/disc/edit/{id}',
	[
		PermanentDiscController::class,
		"edit_permanent_disc"
	]
)->name( "permanent_disc_edit" );
Route::get(
	'/permanent/disc/view/{id}',
	[
		PermanentDiscController::class,
		"view_permanent_disc"
	]
)->name( "api_view_permanent_disc" );

Route::post('api/eggs/new', [EggsController::class, "create_eggs"])->name("api_create_eggs");
Route::post('api/eggs', [EggsController::class, "update_eggs"])->name("api_update_eggs");
Route::get('api/eggs', [EggsController::class, "list_eggs"])->name("api_list_eggs");
Route::get('api/eggs/{id}', [EggsController::class, "list_eggs"])->name("api_get_eggs_by_id");
Route::delete('api/eggs/{id}', [EggsController::class, "delete_eggs"])->name("api_delete_eggs");
Route::get('eggs/edit/{id}', [EggsController::class, "edit_eggs"])->name("eggs_edit");
Route::get('eggs/view/{id}', [EggsController::class, "view_eggs"])->name("api_eggs_view");


Route::get('eggs/edit/{id}', [EggsController::class, "edit_eggs"])->name("eggs_edit");


Route::post('api/company/registration/new', [CompanyRegistrationController::class, "create_company_registration"])->name("api_create_company_registration");
//confirm with mobile on
Route::post('api/company/registration/{id}', [CompanyRegistrationController::class, "update_company_registration"])->name("api_update_company_registration");
Route::get('api/company/registration', [CompanyRegistrationController::class, "list_company_registration"])->name("api_get_company_registration");
Route::get('api/company/registration/user/{user_id}', [CompanyRegistrationController::class, "list_company_registration_by_user"])->name("api_get_company_registration_by_user");
Route::get('api/company/registration/get/{id}', [CompanyRegistrationController::class, "list_company_registration"])->name("api_get_company_registration_by_id");
Route::delete('api/company/registration/{id}', [CompanyRegistrationController::class, "delete_company_registration"])->name("api_delete_company_registration");
Route::get('company/registration/edit/{id}', [CompanyRegistrationController::class, 'company_registration_edit'])->name('api_company_registration_edit');
Route::get('company/registration/view/{id}', [CompanyRegistrationController::class, 'company_registration_view'])->name('api_company_registration_view');


Route::post('api/company/registration/supplier/new', [CompanyRegistrationSupplierController::class, "create_company_registration_supplier"])->name("api_create_company_registration_supplier");
Route::post('api/company/registration/supplier/{id}', [CompanyRegistrationSupplierController::class, "update_company_registration_supplier"])->name("api_update_company_registration_supplier");
Route::get('api/company/registration/supplier', [CompanyRegistrationSupplierController::class, "list_company_registration_supplier"])->name("api_get_company_registration_supplier");
Route::get('api/company/registration/supplier/get/{id}', [CompanyRegistrationSupplierController::class, "list_company_registration_supplier_by_id"])->name("api_get_company_registration_supplier_by_id");
Route::delete('api/company/registration/supplier/{id}', [CompanyRegistrationSupplierController::class, "delete_company_registration_supplier"])->name("api_delete_company_registration_supplier");
Route::get('api/edit/company/registration/supplier/get/{id}', [CompanyRegistrationSupplierController::class, "edit_company_registration_supplier"])->name("api_edit_company_registration_supplier");
Route::get('api/edit/company/registration/supplier/view/{id}', [CompanyRegistrationSupplierController::class, "view_company_registration_supplier"])->name("api_view_company_registration_supplier");



Route::get('api/edit/company/registration/supplier/get/{id}', [CompanyRegistrationSupplierController::class, "edit_company_registration_supplier"])->name("api_edit_company_registration_supplier");



Route::post('api/ecocash/transaction_type/add', [EcocashTransactionTypeController::class, "create_ecocash_transaction_type"])->name("api_create_ecocash_transaction_type");
Route::post('api/ecocash/transaction_type/add/{id}', [EcocashTransactionTypeController::class, "update_ecocash_transaction_type"])->name("api_update_ecocash_transaction_type");
Route::get('api/ecocash/transaction_type', [EcocashTransactionTypeController::class, "list_ecocash_transaction_type"])->name("api_get_ecocash_transaction_type");
Route::delete('api/ecocash/transaction_type/{id}', [EcocashTransactionTypeController::class, "delete_ecocash_transaction_type"])->name("api_delete_ecocash_transaction_type");
Route::get('api/ecocash/transaction/type/edit/{id}', [EcocashTransactionTypeController::class, 'ecocash_transaction_type_edit'])->name('api_ecocash_transaction_type_edit');
Route::get('api/ecocash/transaction/type/view/{id}', [EcocashTransactionTypeController::class, 'ecocash_transaction_type_view'])->name('api_ecocash_transaction_type_view');

Route::post('api/general_sales/transaction_type/add', [GeneralSaleTransactionTypeController::class, "create_general_sale_transaction_type"])->name("api_create_general_sales_transaction_type");
Route::post('api/general_sales/transaction_type/add/{id}', [GeneralSaleTransactionTypeController::class, "update_general_sale_transaction_type"])->name("api_update_general_sales_transaction_type");
Route::get('api/general_sales/transaction_type', [GeneralSaleTransactionTypeController::class, "list_general_sale_transaction_type"])->name("api_get_general_sales_transaction_type");
Route::delete('api/general_sales/transaction_type/{id}', [GeneralSaleTransactionTypeController::class, "delete_general_sale_transaction_type"])->name("api_delete_general_sales_transaction_type");

Route::post('api/zinara/transaction_type/add', [ZinaraTransactionTypeController::class, "create_zinara_transaction_type"])->name("api_create_zinara_transaction_type");
Route::post('api/zinara/transaction_type/add/{id}', [ZinaraTransactionTypeController::class, "update_zinara_transaction_type"])->name("api_update_zinara_transaction_type");
Route::get('api/zinara/transaction_type', [ZinaraTransactionTypeController::class, "list_zinara_transaction_type"])->name("api_get_zinara_transaction_type");
Route::delete('api/zinara/transaction_type/{id}', [ZinaraTransactionTypeController::class, "delete_zinara_transaction_type"])->name("api_delete_zinara_transaction_type");

Route::post('api/rtgs/transaction_type/add', [RTGSTransactionTypeController::class, "create_rtgs_transaction_type"])->name("api_create_rtgs_transaction_type");
Route::post('api/rtgs/transaction_type/add/{id}', [RTGSTransactionTypeController::class, "update_rtgs_transaction_type"])->name("api_update_rtgs_transaction_type");
Route::get('api/rtgs/transaction_type', [RTGSTransactionTypeController::class, "list_rtgs_transaction_type"])->name("api_get_rtgs_transaction_type");
Route::delete('api/rtgs/transaction_type/{id}', [RTGSTransactionTypeController::class, "delete_rtgs_transaction_type"])->name("api_delete_rtgs_transaction_type");

Route::post('api/zinara/add', [ZinaraTransactionController::class, "create_zinara_transaction"])->name("api_create_zinara");
Route::post('api/zinara/add/{id}', [ZinaraTransactionController::class, "update_zinara_transaction"])->name("api_update_zinara");
Route::get('api/zinara', [ZinaraTransactionController::class, "list_zinara_transaction"])->name("api_get_zinara");
Route::get('api/zinara/{user_id}', [ZinaraTransactionController::class, "list_zinara_transaction_by_user_id"])->name("api_get_zinara_by_user");
Route::delete('api/zinara/{id}', [ZinaraTransactionController::class, "delete_zinara_transaction"])->name("api_delete_zinara");

Route::post('api/general_sales/add', [GeneralSalesController::class, "create_general_sale"])->name("api_create_general_sale");
Route::post('api/general_sales/add/{id}', [GeneralSalesController::class, "update_general_sale"])->name("api_update_general_sale");
Route::get('api/general_sales', [GeneralSalesController::class, "list_general_sale"])->name("api_get_general_sale");
Route::delete('api/general_sales/{id}', [GeneralSalesController::class, "delete_general_sale"])->name("api_delete_general_sale");

Route::post('api/ecocash/add', [EcocashController::class, "create_ecocash"])->name("api_create_ecocash");
Route::post('api/ecocash/add/{id}', [EcocashController::class, "update_ecocash"])->name("api_update_ecocash");
Route::get('api/ecocash', [EcocashController::class, "list_ecocash"])->name("api_get_ecocash");
Route::get('api/ecocash/user/{user_id}', [EcocashController::class, "list_ecocash_by_user"])->name("api_get_ecocash_by_user");
Route::delete('api/ecocash/{id}', [EcocashController::class, "delete_ecocash"])->name("api_delete_ecocash");
Route::get('ecocash/edit/{id}', [EcocashController::class, 'ecocash_edit'])->name('ecocash_edit');
Route::get('ecocash/view/{id}', [EcocashController::class, 'ecocash_view'])->name('api_ecocash_view');




Route::post('api/ecocash/agent_line/add', [EcocashAgentLineController::class, "create_ecocash_agent_line"])->name("api_create_ecocash_agent_line");
Route::post('api/ecocash/agent_line/add/{id}', [EcocashAgentLineController::class, "update_ecocash_agent_line"])->name("api_update_ecocash_agent_line");
Route::get('api/ecocash/agent_line', [EcocashAgentLineController::class, "list_ecocash_agent_line"])->name("api_get_ecocash_agent_line");
Route::delete('api/ecocash/agent_line/{id}', [EcocashAgentLineController::class, "delete_ecocash_agent_line"])->name("api_delete_ecocash_agent_line");
Route::get('ecocssh/agent/line/edit/{id}', [EcocashAgentLineController::class, 'ecocash_line_edit'])->name('api_ecocash_line_edit');
Route::get('ecocssh/agent/line/view/{id}', [EcocashAgentLineController::class, 'ecocash_line_view'])->name('api_ecocash_line_view');





Route::post('api/vehicle/class/new', [VehicleClassController::class, "create_vehicle_class"])->name("api_create_vehicle_class");
Route::get('api/vehicle/class', [VehicleClassController::class, "list_vehicle_class"])->name("api_get_vehicle_class");
Route::delete('api/vehicle/class/{id}', [VehicleClassController::class, "delete_vehicle_class"])->name("api_delete_vehicle_class");
Route::get('vehicle/class/edit/{id}', [VehicleClassController::class, 'vehicle_class_edit'])->name('vehicle_class_edit');
Route::post('api/vehicle/class/edit/{id}', [VehicleClassController::class, "update_vehicle_class"])->name("api_update_vehicle_class");
Route::get('api/vehicle/class/view/{id}', [VehicleClassController::class, "vehicle_class_view"])->name("api_vehicle_class_view");

Route::post(
	'api/currency/add/new',
	[
		CurrencyController::class,
		"create_currency"
	]
)->name( "api_create_currency" );
Route::get(
	'api/currency',
	[
		CurrencyController::class,
		"getCurrency"
	]
)->name( "api_get_currency" );
Route::get(
	'api/currency/{currency}',
	[
		CurrencyController::class,
		"getCurrency"
	]
)->name( "api_get_single_currency" );
Route::get(
	'api/currency/get/exchange-rate',
	[
		CurrencyController::class,
		"getExchangeRate"
	]
)->name( "api_currency_exchange_rate" );
Route::get(
	'currency/edit/{id}',
	[
		CurrencyController::class,
		'currency_edit'
	]
)->name( 'currency_edit' );
Route::post(
	'api/currency/add/{id}',
	[
		CurrencyController::class,
		"update_currency"
	]
)->name( "api_update_currency" );
Route::delete(
	'api/currency/{id}',
	[
		CurrencyController::class,
		"delete_currency"
	]
)->name( "api_delete_currency" );

Route::post(
	'api/client/add',
	[
		ClientController::class,
		"create_client"
	]
)->name( "api_create_client" );
Route::post(
	'api/client/add/{id}',
	[
		ClientController::class,
		"update_client"
	]
)->name( "api_update_client" );
Route::get(
	'api/client',
	[
		ClientController::class,
		"list_clients"
	]
)->name( "api_list_clients" );
Route::get(
	'api/client/{id}',
	[
		ClientController::class,
		"list_clients"
	]
)->name( "api_list_client" );
Route::get(
	'api/client/search/{search}',
	[
		ClientController::class,
		"searchClient"
	]
)->name( "api_search_clients" );
Route::delete(
	'api/client/{id}',
	[
		ClientController::class,
		"delete_client"
	]
)->name( "api_delete_client" );
Route::get(
	'api/client/edit/{id}',
	[
		ClientController::class,
		"client_edit"
	]
)->name( "client_edit" );
Route::get(
	'api/client/view/{id}',
	[
		ClientController::class,
		"client_view"
	]
)->name( "api_client_view" );

Route::post(
	'api/dstv/package/add',
	[
		DSTVPackageController::class,
		"create_dstv_package"
	]
)->name( "api_create_dstv_package" );
Route::post(
	'api/dstv/package/add/{id}',
	[
		DSTVPackageController::class,
		"update_dstv_package"
	]
)->name( "api_update_dstv_package" );
Route::get(
	'api/dstv/package',
	[
		DSTVPackageController::class,
		"list_dstv_package"
	]
)->name( "api_list_dstv_package" );
Route::get(
	'api/dstv/package/{id}',
	[
		DSTVPackageController::class,
		"list_dstv_package"
	]
)->name( "api_list_dstv_package_by_id" );
Route::delete(
	'api/dstv/package/{id}',
	[
		DSTVPackageController::class,
		"delete_dstv_package"
	]
)->name( "api_delete_dstv_package" );
Route::get('api/dstv/package/edit/{id}', [DSTVPackageController::class, 'dstv_package_edit'])->name('dstv_package_edit');
Route::get('api/dstv/package/view/{id}', [DSTVPackageController::class, 'dstv_package_view'])->name('api_dstv_package_view');



Route::post('api/dstv/transaction/add', [DSTVTransactionController::class, "create_dstv_transaction"])->name("api_create_dstv_transaction");
Route::post('api/dstv/transaction/add/{id}', [DSTVTransactionController::class, "update_dstv_transaction"])->name("api_update_dstv_transaction");
Route::get('api/dstv/transaction', [DSTVTransactionController::class, "list_dstv_transaction"])->name("api_list_dstv_transaction");
Route::get('api/dstv/transaction/{id}', [DSTVTransactionController::class, "list_dstv_transaction"])->name("api_list_dstv_transaction_by_id");
Route::get('api/dstv/transaction/user/{user_id}', [DSTVTransactionController::class, "list_dstv_transaction_by_user_id"])->name("api_list_dstv_transaction_by_user_id");
Route::delete('api/dstv/transaction/{id}', [DSTVTransactionController::class, "delete_dstv_transaction"])->name("api_delete_dstv_transaction");
Route::get('dstv/transaction/edit/{id}', [DSTVTransactionController::class, 'dstv_transaction_edit'])->name('dstv_transaction_edit');
Route::get('dstv/transaction/view/{id}', [DSTVTransactionController::class, 'dstv_transaction_view'])->name('dstv_transaction_view');


Route::post('api/dstv/payment/add', [DSTVPaymentController::class, "create_dstv_payment"])->name("api_create_dstv_payment");
Route::get('api/dstv/payment/{transaction_id}', [DSTVPaymentController::class, "list_dstv_payments"])->name("api_list_dstv_payments_by_transaction_id");
Route::delete('api/dstv/payment/{id}', [DSTVPaymentController::class, "delete_dstv_payment"])->name("api_delete_dstv_payment");

Route::post('api/insurance/payment/add', [InsurancePaymentController::class, "create_insurance_payment"])->name("api_create_insurance_payment");
Route::post('api/insurance/payment/add/{id}', [InsurancePaymentController::class, "update_insurance_payment"])->name("api_update_insurance_payment");
Route::get('api/insurance/payment', [InsurancePaymentController::class, "list_insurance_payment"])->name("api_list_insurance_payment");
Route::get('api/insurance/payment/{id}', [InsurancePaymentController::class, "list_insurance_payment"])->name("api_list_insurance_payment_by_id");
Route::delete('api/insurance/payment/{id}', [InsurancePaymentController::class, "delete_insurance_payment"])->name("api_delete_insurance_payment");

Route::post('api/insurance/transaction/add', [InsuranceTransactionController::class, "create_insurance_transaction"])->name("api_create_insurance_transaction");
Route::post('api/insurance/transaction/add/{id}', [InsuranceTransactionController::class, "update_insurance_transaction"])->name("api_update_insurance_transaction");
Route::get('api/insurance/transaction', [InsuranceTransactionController::class, "list_insurance_transaction"])->name("api_list_insurance_transaction");
Route::get('api/insurance/transaction/{user_id}', [InsuranceTransactionController::class, "list_insurance_transaction_by_user"])->name("api_list_insurance_transaction_by_user");
Route::get('api/insurance/transaction/{id}', [InsuranceTransactionController::class, "list_insurance_transaction"])->name("api_list_insurance_transaction_by_id");
Route::delete('api/insurance/transaction/{id}', [InsuranceTransactionController::class, "delete_insurance_transaction"])->name("api_delete_insurance_transaction");
Route::get('insurance/transaction/edit/{id}', [InsuranceTransactionController::class, 'insurance_transaction_edit'])->name('insurance_transaction_edit');
Route::get('insurance/transaction/view/{id}', [InsuranceTransactionController::class, 'insurance_transaction_view'])->name('api_insurance_transaction_view');

Route::post('api/insurance/broker/add', [InsuranceBrokerController::class, "create_insurance_broker"])->name("api_create_insurance_broker");
Route::post('api/insurance/broker/add/{id}', [InsuranceBrokerController::class, "update_insurance_broker"])->name("api_update_insurance_broker");
Route::get('api/insurance/broker', [InsuranceBrokerController::class, "list_insurance_broker"])->name("api_list_insurance_broker");
Route::delete('api/insurance/broker/{id}', [InsuranceBrokerController::class, "delete_insurance_broker"])->name("api_delete_insurance_broker");
Route::get('api/insurance/broker/edit/{id}', [InsuranceBrokerController::class, 'insurance_broker_edit'])->name('insurance_broker_edit');
Route::get('api/insurance/broker/view/{id}', [InsuranceBrokerController::class, 'insurance_broker_view'])->name('api_insurance_broker_view');



Route::post('api/loan/disbursed/add', [LoanDisbursedController::class, "create_loan_disbursed"])->name("api_create_loan_disbursed");
Route::post('api/loan/disbursed/add/{id}', [LoanDisbursedController::class, "update_loan_disbursed"])->name("api_update_loan_disbursed");
Route::get('api/loan/disbursed', [LoanDisbursedController::class, "list_loan_disbursed"])->name("api_list_loan_disbursed");
Route::get('api/loan/disbursed/{user_id}', [LoanDisbursedController::class, "list_loan_disbursed"])->name("api_list_loan_disbursed_by_user_id");
Route::delete('api/loan/disbursed/{id}', [LoanDisbursedController::class, "delete_loan_disbursed"])->name("api_delete_loan_disbursed");
Route::get('api/loan/disbursed/edit/{id}', [LoanDisbursedController::class, 'loan_disbursed_edit'])->name('loan_disbursed_edit');
Route::get('api/loan/disbursed/view/{id}', [LoanDisbursedController::class, 'loan_disbursed_view'])->name('api_loan_disbursed_view');


Route::post('api/loan/payment/add', [LoanPaymentController::class, "create_loan_payment"])->name("api_create_loan_payment");
Route::post('api/loan/payment/add/{id}', [LoanPaymentController::class, "update_loan_payment"])->name("api_update_loan_payment");
Route::get('api/loan/payment/{loan_id}', [LoanPaymentController::class, "list_loan_payment"])->name("api_list_loan_payment_by_loan_id");
Route::delete('api/loan/payment/{id}', [LoanPaymentController::class, "delete_loan_payment"])->name("api_delete_loan_payment");

Route::post('api/loan/check', [LoanDisbursedController::class, "loan_check"])->name("api_check_loan");

Route::post('api/notes/add', [NotesController::class, "create_notes"])->name("api_create_notes");
Route::get('api/notes/get/{date}', [NotesController::class, "list_notes"])->name("api_get_notes");
Route::get('api/notes/edit/{id}', [NotesController::class, 'notes_edit'])->name('api_notes_edit');
Route::post(
	'api/notes/add/{id}',
	[
		NotesController::class,
		"update_notes"
	]
)->name( "api_update_notes" );
Route::delete(
	'api/notes/{id}',
	[
		NotesController::class,
		"delete_user"
	]
)->name( "api_delete_notes" );

Route::post(
	'api/user/add',
	[
		UsersController::class,
		"create_user"
	]
)->name( "api_create_user" );
//Route::post('add', [UsersController::class, "create_user"])->name("api_create_user");
Route::post(
	'api/user/add/{id}',
	[
		UsersController::class,
		"update_user"
	]
)->name( "api_update_user" );
Route::post(
	'api/user/password/{id}',
	[
		UsersController::class,
		"update_user_password"
	]
)->name( "api_update_user_password" );
Route::get(
	'api/user',
	[
		UsersController::class,
		"list_users"
	]
)->name( "api_list_users" );
Route::get(
	'api/user/{id}',
	[
		UsersController::class,
		"list_users"
	]
)->name( "api_list_users_by_id" );
Route::delete(
	'api/user/{id}',
	[
		UsersController::class,
		"delete_user"
	]
)->name( "api_delete_user" );
Route::get(
	'api/user/edit/{id}',
	[
		UsersController::class,
		"user_edit"
	]
)->name( "user_edit" );
Route::get(
	'api/user/view/{id}',
	[
		UsersController::class,
		"user_view"
	]
)->name( "api_user_view" );

Route::get(
	'api/summary/ecocash/{user_id}/{start_date}/{end_date}',
	[
		EcocashController::class,
		"summary"
	]
)->name( "api_summary_ecocash" );

Route::get(
	'api/summary/{user_id}/{start_date}/{end_date}',
	[
		SummaryController::class,
		"summary"
	]
)->name( "api_summary" );

Route::post(
	'api/agent/new',
	[
		AgentController::class,
		'create_agent'
	]
)->name( 'api_create_agent' );
Route::post(
	'api/agent/edit/{id}',
	[
		AgentController::class,
		'update_agent'
	]
)->name( 'api_update_agent' );
Route::get(
	'api/agent',
	[
		AgentController::class,
		'list_agents'
	]
)->name( 'api_list_agents' );
Route::get(
	'api/agent/{id}',
	[
		AgentController::class,
		'get_agent_by_id'
	]
)->name( 'api_get_agent_by_id' );
Route::delete(
	'api/agent/delete/{id}',
	[
		AgentController::class,
		'delete_agent'
	]
)->name( 'api_delete_agent' );
Route::get(
	'api/agent/view/{id}',
	[
		AgentController::class,
		"agent_view"
	]
)->name( "api_agent_view" );

Route::get(
	'billing',
	function () {
		return view( 'pages.billing' );
	}
)->name( 'billing' );
Route::get(
	'tables',
	function () {
		return view( 'pages.tables' );
	}
)->name( 'tables' );
Route::get(
	'rtl',
	function () {
		return view( 'pages.rtl' );
	}
)->name( 'rtl' );
Route::get(
	'virtual-reality',
	function () {
		return view( 'pages.virtual-reality' );
	}
)->name( 'virtual-reality' );
Route::get(
	'notifications',
	function () {
		return view( 'pages.notifications' );
	}
)->name( 'notifications' );
Route::get(
	'static-sign-in',
	function () {
		return view( 'pages.static-sign-in' );
	}
)->name( 'static-sign-in' );
Route::get(
	'static-sign-up',
	function () {
    return view('pages.static-sign-up');
})->name('static-sign-up');
Route::get('user-management', function () {
    return view('pages.laravel-examples.user-management');
})->name('user-management');
Route::get('user-profile', function () {
    return view('pages.laravel-examples.user-profile');
})->name('user-profile');


Route::group([], function () {
	Route::get(
		'general-sales',
		[
			GeneralSalesController::class,
			'viewTransactions'
		]
	)->name( 'general-sales' );
	Route::get(
		'view-general-sale/{transaction}/{del?}',
		[
			GeneralSalesController::class,
			'viewTransaction'
		]
	)->name( 'view-general-sale' );
	Route::get(
		'create-general-sale',
		[
			GeneralSalesController::class,
			'createTransaction'
		]
	)->name( 'create-general-sale' );
	Route::get(
		'edit-general-sale/{saleId}',
		[
			EditGeneralSale::class,
			'editGeneralSale'
		]
	)->name( 'edit-general-sale' );
	Route::post(
		'store-general-sale',
		[
			GeneralSalesController::class,
			'storeTransaction'
		]
	)->name( 'store-general-sale' );
	Route::post(
		'update-general-sale',
		[
			GeneralSalesController::class,
			'updateTransaction'
		]
	)->name( 'update-general-sale' );
	Route::get(
		'delete-general-sale/{saleId}',
		[
			GeneralSalesController::class,
			'deleteTransaction'
		]
	)->name( 'delete-general-sale' );
});
