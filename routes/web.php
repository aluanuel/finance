<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtisanController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

/**************************** loans ***********************************/
	Route::get('/apply/loans/all/', [App\Http\Controllers\LoansController::class, 'view_all_loans'])->name('view_all_loans');

	Route::post('/apply/loans/all',[App\Http\Controllers\LoansController::class, 'search_all_loans']);

	Route::get('/apply/loans/individual/', [App\Http\Controllers\LoansController::class, 'view_individual_loans'])->name('view_individual_loans');

	Route::post('/apply/loans/individual/',[App\Http\Controllers\LoansController::class, 'search_individual_loans']);

	Route::get('/apply/loans/group/', [App\Http\Controllers\LoansController::class, 'view_group_loans'])->name('view_group_loans');

	Route::post('/apply/loans/group',[App\Http\Controllers\LoansController::class, 'search_group_loans']);









	

	Route::post('/apply/loan/new', [App\Http\Controllers\LoansController::class, 'create_new_loan']);

	Route::get('/apply/ind/loan/{id}', [App\Http\Controllers\LoansController::class, 'view_individual_loan_details']);

	Route::post('/apply/ind/loan/{id}', [App\Http\Controllers\LoansController::class, 'update_individual_loan_application']);

	Route::post('/apply/admin/ind/loan/{id}', [App\Http\Controllers\LoansController::class, 'admin_update_individual_loan_application']);

	Route::get('/apply/grp/loan/{id}', [App\Http\Controllers\LoansController::class, 'view_group_loan_details']);

	Route::post('/apply/grp/loan/{id}', [App\Http\Controllers\LoansController::class, 'update_group_loan_application']);

	Route::post('/apply/admin/grp/loan/{id}', [App\Http\Controllers\LoansController::class, 'admin_update_group_loan_application']);

	Route::get('apply/loan/repayment',[App\Http\Controllers\TransactionsController::class,'view_loan_repayments']);

	Route::post('apply/loan/repayment/{id}',[App\Http\Controllers\TransactionsController::class,'create_loan_repayment_entry']);

	Route::post('apply/loan/reinstate/{id}',[App\Http\Controllers\TransactionsController::class,'reinstate_loan']);




	

	Route::post('/apply/ind/cont/{id}', [App\Http\Controllers\LoansController::class, 'continueIndividualApplication']);

	Route::get('/apply/wiew/loan_list/{id}',[App\Http\Controllers\ClientsController::class, 'ViewClientLoanList'])->name('viewLoanList');

	Route::get('/apply/grp/processed',[App\Http\Controllers\LoansController::class, 'adminViewGroupProcessedLoans']);
	Route::get('/apply/ind/processed', [App\Http\Controllers\LoansController::class, 'adminViewIndividualProcessedLoans']);

/******************************** Teller ************************************/
	Route::get('/apply/ind/teller/', [App\Http\Controllers\LoansController::class, 'view_individual_loans_list'])->name('tellerSingleViewApplications');

	Route::get('/apply/teller/ind/processed/', [App\Http\Controllers\LoansController::class, 'viewIndividualProcessedLoans']);

	Route::get('/apply/grp/teller/', [App\Http\Controllers\LoansController::class, 'view_group_loans_list']);

	Route::post('/apply/loan/disburse/{id}',[App\Http\Controllers\LoansController::class, 'disburse_approved_loan']);

	Route::get('/apply/teller/grp/processed/', [App\Http\Controllers\LoansController::class, 'viewGroupProcessedLoans']);

	Route::post('/apply/teller/ind/{id}', [App\Http\Controllers\ClientsController::class, 'updateIndividualApplication']);

	Route::post('/apply/teller/process/{id}', [App\Http\Controllers\LoansController::class, 'startIndividualProcessedLoans']);
	Route::get('/apply/teller/trans/process/{id}', [App\Http\Controllers\LoansController::class, 'ViewLoanProcessingForm']);

	Route::get('/apply/teller/transaction/', [App\Http\Controllers\TransactionsController::class, 'index'])->name('transaction_form')->name('transactions');

	Route::post('/apply/teller/transaction', [App\Http\Controllers\TransactionsController::class, 'create_new_transaction_entry']);

	Route::post('/apply/teller/transaction/{id}', [App\Http\Controllers\TransactionsController::class, 'update_transaction_entry']);


	

	Route::get('/apply/teller/trans/security/{id}', [App\Http\Controllers\LoansController::class, 'ReturnLoanSecurity']);

	Route::post('/apply/teller/trans/security/{id}', [App\Http\Controllers\LoansController::class, 'TellerIssueLoanSecurity']);

	Route::get('/apply/settings/loan/group/members/{id}', [App\Http\Controllers\LoanGroupsController::class, 'view_loan_group_members']);
	Route::post('/apply/settings/loan/group/members/{id}', [App\Http\Controllers\LoanGroupsController::class, 'update_loan_group_member_role']);


	Route::get('/apply/view/ind/processed', [App\Http\Controllers\LoansController::class, 'viewIndividualProcessedLoan'])->name('tellerSingleProcessedLoans');
	
	
	Route::post('/apply/ind/update/{id}', [App\Http\Controllers\LoansController::class, 'updateIndividualApplication']);

	Route::get('/apply/admin/ind/', [App\Http\Controllers\LoansController::class, 'adminViewIndividualApplication']);
	
	Route::get('/app/ind/schedule/{id}', [App\Http\Controllers\LoansController::class, 'individualLoanPaymentSchedule']);
	Route::get('apply/ind/accept/{id}', [App\Http\Controllers\LoansController::class, 'acceptLoan']);
	Route::get('/apply/admin/processed', [App\Http\Controllers\LoansController::class, 'adminViewIndividualProcessedLoans']);

	Route::get('/apply/trans/accounts/{id}', [App\Http\Controllers\ClientsController::class, 'index']);
	Route::post('/apply/trans/accounts/{id}', [App\Http\Controllers\ClientsController::class, 'RecordAppraisalFeePayment']);

/***************************pdf documents********************************/

	Route::get('/apply/account/profile/{id}', [App\Http\Controllers\ClientsController::class, 'view_client_details'])->name('clientProfile');

	Route::post('/apply/account/profile/{id}', [App\Http\Controllers\ClientsController::class, 'update_client_account_details']);	

	/**********************************Reports******************************************/
	Route::get('/apply/report/disbursements/',[App\Http\Controllers\ReportsController::class,'report_loan_disbursements']);

	Route::get('/apply/report/disbursements/{id}',[App\Http\Controllers\ReportsController::class,'report_loan_disbursements']);

	Route::post('/apply/report/disbursements',[App\Http\Controllers\ReportsController::class,'query_report_loan_disbursements']);

	Route::get('/apply/report/loan-recovery/',[App\Http\Controllers\ReportsController::class,'report_loan_recovery']);

	Route::get('/apply/report/loan-recovery/{id}',[App\Http\Controllers\ReportsController::class,'report_loan_recovery']);

	Route::post('/apply/report/loan-recovery',[App\Http\Controllers\ReportsController::class,'query_report_loan_recovery']);

	Route::get('/apply/report/loans-fully-settled/',[App\Http\Controllers\ReportsController::class,'report_loans_fully_settled']);

	Route::get('/apply/report/loans-fully-settled/{id}',[App\Http\Controllers\ReportsController::class,'report_loans_fully_settled']);

	Route::post('/apply/report/loans-fully-settled/',[App\Http\Controllers\ReportsController::class,'query_report_loans_fully_settled']);

	Route::get('/apply/report/loans-defaulted/',[App\Http\Controllers\ReportsController::class,'report_loans_defaulted']);

	Route::get('/apply/report/cashbook',[App\Http\Controllers\ReportsController::class,'report_cashbook']);

	Route::get('/apply/report/balance_sheet',[App\Http\Controllers\ReportsController::class,'report_balance_sheet']);

	Route::get('/apply/report/cash_inflow',[App\Http\Controllers\ReportsController::class,'report_cash_inflow']);

	Route::get('/apply/report/cash_outflow',[App\Http\Controllers\ReportsController::class,'report_cash_outflow']);

	/*=================== Reports accessible by loan officers ==============*/

	Route::get('/apply/report/officer/loan_disbursements/{id}',[App\Http\Controllers\ReportsController::class,'report_officer_loan_disbursements']);

	Route::get('/apply/report/officer/loan_recovery/{id}',[App\Http\Controllers\ReportsController::class,'report_officer_loan_recovery']);


	/*================= Restore previous loans============================*/

	Route::get('/apply/restore/previous/loan/',[App\Http\Controllers\LoansController::class,'restore_previous_loan']);

	Route::post('/apply/restore/previous/loan',[App\Http\Controllers\LoansController::class,'record_previous_loan']);


	Route::get('/apply/system/backup/',[App\Http\Controllers\ArtisanController::class,'backup']);
	Route::post('/apply/system/backup',[App\Http\Controllers\ArtisanController::class,'run_backup']);
	Route::get('/apply/system/restore/',[App\Http\Controllers\ArtisanController::class,'restore']);
	Route::post('/apply/system/restore',[App\Http\Controllers\ArtisanController::class,'run_restore']);


	/*=================== Reports accessible by loan officers ==============*/



	



	Route::get('/apply/analysis/loan/',[App\Http\Controllers\ReportsController::class,'LoanList']);
	Route::get('/apply/analysis/loan/{id}',[App\Http\Controllers\ReportsController::class,'LoanPerformance']);

	/*******************************settings************************************/

	Route::get('/apply/grp', [App\Http\Controllers\LoansController::class, 'view_group_loans_list']);

	Route::get('/apply/grp/{id}',[App\Http\Controllers\LoansController::class, 'index']);

	Route::post('/apply/grp/{id}',[App\Http\Controllers\LoansController::class, 'new_loan_application']);

	Route::post('/apply/grp/loan/assess/{id}',[App\Http\Controllers\LoansController::class, 'loan_assessment']);

	Route::post('/apply/grp/loan/disburse/{id}',[App\Http\Controllers\LoansController::class, 'loan_disbursement']);

	Route::get('/apply/settings/users', [App\Http\Controllers\SystemUsersController::class, 'system_users']);
	Route::post('/apply/settings/user', [App\Http\Controllers\SystemUsersController::class, 'create_system_user']);
	Route::get('/apply/settings/manage', [App\Http\Controllers\SystemUsersController::class, 'manage_user']);
	Route::get('/apply/settings/manage/{id}', [App\Http\Controllers\SystemUsersController::class, 'TemporaryPassword']);
	Route::get('apply/user/{id}',[App\Http\Controllers\SystemUsersController::class, 'view_user_profile']);
	Route::post('/apply/user/update/{id}',[App\Http\Controllers\SystemUsersController::class, 'update_user_password']);
	Route::post('/apply/user/update/photo/{id}',[App\Http\Controllers\SystemUsersController::class, 'update_user_photo']);

	Route::get('/apply/settings/fees/',[App\Http\Controllers\FeesController::class, 'index']);
	Route::post('/apply/settings/fees',[App\Http\Controllers\FeesController::class, 'create_new_fees']);

	Route::get('/apply/settings/rates/',[App\Http\Controllers\RatesController::class, 'index']);
	Route::post('/apply/settings/rates',[App\Http\Controllers\RatesController::class, 'create_new_rate']);

	Route::get('/apply/settings/loan/groups',[App\Http\Controllers\LoanGroupsController::class,'index']);
	Route::post('/apply/settings/loan/groups',[App\Http\Controllers\LoanGroupsController::class,'create_new_loan_group']);
	
	
	Route::get('/apply/admin/grp/processed',[App\Http\Controllers\LoansController::class, 'adminViewGroupProcessedLoans']);
	

	// view active accounts by the loan officer
	Route::get('/apply/accounts',[App\Http\Controllers\ClientsController::class,'index']);

	// display account creation form by the loan officer
	Route::get('/apply/accounts/new/',[App\Http\Controllers\ClientsController::class,'index']);

	// register a new client by the loan officer
	Route::post('/apply/accounts/new',[App\Http\Controllers\ClientsController::class,'create_client_account']);

	Route::get('/apply/accounts/applications/',[App\Http\Controllers\ClientsController::class,'view_inactive_new_client_accounts']);

	Route::post('/apply/accounts/applications/{id}',[App\Http\Controllers\ClientsController::class,'activate_new_client_account']);

	Route::get('/apply/admin/accounts',[App\Http\Controllers\ClientsController::class,'view_client_accounts']);
	Route::get('/apply/admin/ind/accounts',[App\Http\Controllers\ClientsController::class,'adminViewIndividualAccounts']);
	Route::get('/apply/admin/grp/accounts',[App\Http\Controllers\ClientsController::class,'adminViewGroupAccounts']);

	Route::get('/admin/download/collateral/{file}', function ($file='') {
    	return response()->file(storage_path('app/public/'.$file));
	});

});

