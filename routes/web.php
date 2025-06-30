<?php

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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

/**************************** Loan Officer ***********************************/
	Route::get('/apply/ind/', [App\Http\Controllers\LoansController::class, 'view_individual_loans_list']);

	Route::post('/apply/loan/new', [App\Http\Controllers\LoansController::class, 'create_new_loan']);

	Route::get('/apply/ind/loan/{id}', [App\Http\Controllers\LoansController::class, 'view_individual_loan_details']);

	Route::post('/apply/ind/loan/{id}', [App\Http\Controllers\LoansController::class, 'update_individual_loan_application']);

	Route::post('/apply/admin/ind/loan/{id}', [App\Http\Controllers\LoansController::class, 'admin_update_individual_loan_application']);

	Route::get('/apply/grp/loan/{id}', [App\Http\Controllers\LoansController::class, 'view_group_loan_details']);

	Route::post('/apply/grp/loan/{id}', [App\Http\Controllers\LoansController::class, 'update_group_loan_application']);

	Route::post('/apply/admin/grp/loan/{id}', [App\Http\Controllers\LoansController::class, 'admin_update_group_loan_application']);

	Route::get('apply/loan/repayment',[App\Http\Controllers\TransactionsController::class,'view_loan_repayments']);

	Route::post('apply/loan/repayment/{id}',[App\Http\Controllers\TransactionsController::class,'create_loan_repayment_entry']);




	Route::get('/apply/ind/assess', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'index'])->name('assessSingle');

	Route::get('/apply/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'assessIndividual']);

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

	Route::get('/apply/teller/transaction/', [App\Http\Controllers\TransactionsController::class, 'index'])->name('transaction_form');

	Route::post('/apply/teller/transaction', [App\Http\Controllers\TransactionsController::class, 'create_new_transaction_entry']);


	Route::get('/apply/teller/trans/{id}', [App\Http\Controllers\LoanRepaymentController::class, 'showPayFormWithLoanSelected']);

	Route::get('/apply/teller/trans/security/{id}', [App\Http\Controllers\LoansController::class, 'ReturnLoanSecurity']);

	Route::post('/apply/teller/trans/security/{id}', [App\Http\Controllers\LoansController::class, 'TellerIssueLoanSecurity']);

	Route::post('/apply/teller/trans', [App\Http\Controllers\LoanRepaymentController::class, 'RecordPayment']);

	Route::post('/apply/teller/trans/search/payment', [App\Http\Controllers\LoanRepaymentController::class, 'SearchPayment']);

	Route::get('/apply/teller/savings/', [App\Http\Controllers\ClientSavingController::class, 'savingsForm']);

	Route::post('/apply/teller/savings', [App\Http\Controllers\ClientSavingController::class, 'Deposit']);

	Route::get('/apply/teller/withdrawal/', [App\Http\Controllers\ClientSavingController::class, 'withdrawalForm']);

	Route::post('/apply/teller/withdrawal', [App\Http\Controllers\ClientSavingController::class, 'Withdrawal']);




	Route::get('/apply/settings/loan/group/members/{id}', [App\Http\Controllers\LoanGroupsController::class, 'view_loan_group_members']);
	Route::post('/apply/settings/loan/group/members/{id}', [App\Http\Controllers\LoanGroupsController::class, 'update_loan_group_member_role']);


	Route::get('/apply/view/ind/processed', [App\Http\Controllers\LoansController::class, 'viewIndividualProcessedLoan'])->name('tellerSingleProcessedLoans');
	
	
	Route::post('/apply/ind/update/{id}', [App\Http\Controllers\LoansController::class, 'updateIndividualApplication']);

	Route::get('/apply/admin/ind/', [App\Http\Controllers\LoansController::class, 'adminViewIndividualApplication']);
	Route::get('/apply/admin/ind/assess', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'adminViewLoan'])->name('adminAssessSingle');
	Route::post('/apply/ind/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'viewAssessmentForm']);
	
	Route::get('/apply/admin/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'adminAssessIndividual']);
	Route::post('/apply/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'FillAssessmentForm']);
	Route::post('/apply/admin/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'AdminFillAssessmentForm']);
	Route::get('/apply/admin/collateral/{id}',[App\Http\Controllers\LoanSecurityController::class, 'index']);
	Route::post('/apply/admin/collateral/{id}',[App\Http\Controllers\LoanSecurityController::class, 'issueSecurity']);
	Route::get('/app/ind/schedule/{id}', [App\Http\Controllers\LoansController::class, 'individualLoanPaymentSchedule']);
	Route::get('apply/ind/accept/{id}', [App\Http\Controllers\LoansController::class, 'acceptLoan']);
	Route::get('/apply/admin/processed', [App\Http\Controllers\LoansController::class, 'adminViewIndividualProcessedLoans']);

	Route::get('/apply/settings/interest', [App\Http\Controllers\InterestOnLoanController::class, 'index']);
	Route::post('/apply/settings/interest', [App\Http\Controllers\InterestOnLoanController::class, 'create']);
	Route::get('/apply/settings/interest/defaulting', [App\Http\Controllers\InterestOnLoanOutstandingController::class, 'index']);
	Route::post('/apply/settings/interest/defaulting', [App\Http\Controllers\InterestOnLoanOutstandingController::class, 'create']);

	Route::get('/apply/trans/accounts/{id}', [App\Http\Controllers\ClientsController::class, 'index']);
	Route::post('/apply/trans/accounts/{id}', [App\Http\Controllers\ClientsController::class, 'RecordAppraisalFeePayment']);

/***************************pdf documents********************************/
	Route::get('/generate/loan/application/{id}', [App\Http\Controllers\PDFController::class, 'CreateLoanApplicationReceipt']);
	Route::get('/generate/loan/payment/receipt/{id}', [App\Http\Controllers\PDFController::class, 'CreateLoanPaymentReceipt']);
	Route::get('/generate/account/statement/{id}', [App\Http\Controllers\PDFController::class, 'CreateAccountStatement']);
	Route::get('/generate/report/accounts', [App\Http\Controllers\PDFController::class, 'CreateAccountsReport']);

	Route::get('/generate/report/collections', [App\Http\Controllers\PDFController::class, 'CreateCollectionsReport']);
	Route::get('/generate/report/expenses', [App\Http\Controllers\PDFController::class, 'CreateExpensesReport']);
	Route::get('/generate/report/incomes', [App\Http\Controllers\PDFController::class, 'CreateIncomesReport']);
	Route::get('/generate/report/cashbook', [App\Http\Controllers\PDFController::class, 'CreateCashBookReport']);

	Route::get('/storage/app/public/{id}', [App\Http\Controllers\PDFController::class, 'ViewLoanSecurity']);

	Route::get('/apply/account/profile/{id}', [App\Http\Controllers\ClientsController::class, 'view_client_details'])->name('clientProfile');

	Route::post('/apply/account/profile/{id}', [App\Http\Controllers\ClientsController::class, 'update_client_account_details'])->name('clientProfile');	

	/**********************************Reports******************************************/
	Route::get('/apply/report/disbursements/',[App\Http\Controllers\ReportsController::class,'report_loan_disbursements']);

	Route::get('/apply/report/disbursements/{id}',[App\Http\Controllers\ReportsController::class,'report_loan_disbursements']);

	Route::get('/apply/report/loan-recovery/',[App\Http\Controllers\ReportsController::class,'report_loan_recovery']);

	Route::get('/apply/report/loan-recovery/{id}',[App\Http\Controllers\ReportsController::class,'report_loan_recovery']);

	Route::get('/apply/report/loans-fully-settled/',[App\Http\Controllers\ReportsController::class,'report_loans_fully_settled']);

	Route::get('/apply/report/loans-fully-settled/{id}',[App\Http\Controllers\ReportsController::class,'report_loans_fully_settled']);

	Route::get('/apply/report/cashbook',[App\Http\Controllers\ReportsController::class,'report_cashbook']);

	Route::get('/apply/report/balance_sheet',[App\Http\Controllers\ReportsController::class,'report_balance_sheet']);

	Route::get('/apply/report/cash_inflow',[App\Http\Controllers\ReportsController::class,'report_cash_inflow']);

	Route::get('/apply/report/cash_outflow',[App\Http\Controllers\ReportsController::class,'report_cash_outflow']);

	/*=================== Reports accessible by loan officers ==============*/

	Route::get('/apply/report/officer/loan_disbursements/{id}',[App\Http\Controllers\ReportsController::class,'report_officer_loan_disbursements']);

	Route::get('/apply/report/officer/loan_recovery/{id}',[App\Http\Controllers\ReportsController::class,'report_officer_loan_recovery']);


	/*================= Restore previous loans============================*/

	Route::get('/apply/restore/previous/loan/',[App\Http\Controllers\LoansController::class,'restore_previous_loan']);

	Route::post('/apply/restore/previous/loan/',[App\Http\Controllers\LoansController::class,'record_previous_loan']);


	/*=================== Reports accessible by loan officers ==============*/



	



	Route::get('/apply/analysis/loan/',[App\Http\Controllers\ReportsController::class,'LoanList']);
	Route::get('/apply/analysis/loan/{id}',[App\Http\Controllers\ReportsController::class,'LoanPerformance']);

	/*******************************settings************************************/
	
	Route::get('/apply/grp/list',[App\Http\Controllers\ClientGroupController::class,'view']);
	Route::post('/apply/grp/list',[App\Http\Controllers\ClientGroupController::class,'newMemberRole']);
	Route::get('/apply/settings/cashflow/',[App\Http\Controllers\TransactionCategoryController::class,'index']);
	Route::post('/apply/settings/cashflow/',[App\Http\Controllers\TransactionCategoryController::class,'create']);

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
	Route::post('/apply/settings/fees/',[App\Http\Controllers\FeesController::class, 'create_new_fees']);

	Route::get('/apply/settings/rates/',[App\Http\Controllers\RatesController::class, 'index']);
	Route::post('/apply/settings/rates/',[App\Http\Controllers\RatesController::class, 'create_new_rate']);

	Route::get('/apply/settings/loan/groups',[App\Http\Controllers\LoanGroupsController::class,'index']);
	Route::post('/apply/settings/loan/groups',[App\Http\Controllers\LoanGroupsController::class,'create_new_loan_group']);
	
	Route::get('/apply/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'index']);
	Route::post('/apply/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'fillAssessment']);
	Route::get('/apply/grp/assess',[App\Http\Controllers\GroupLoanAssessmentController::class, 'viewAssessment']);
	Route::get('/apply/admin/grp/',[App\Http\Controllers\LoansController::class, 'adminViewGroupApplications']);
	Route::get('/apply/admin/grp/assess',[App\Http\Controllers\GroupLoanAssessmentController::class, 'adminViewAssessment'])->name('AdminGroupAssessment');
	Route::get('/apply/admin/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'adminViewAssessmentSingle']);
	Route::post('/apply/admin/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'adminFillAssessmentForm']);
	Route::get('/apply/admin/grp/processed',[App\Http\Controllers\LoansController::class, 'adminViewGroupProcessedLoans']);
	Route::get('/apply/admin/reinstate/{id}',[App\Http\Controllers\LoansController::class,'ViewReinstateLoanForm']);
	Route::post('/apply/admin/reinstate/{id}',[App\Http\Controllers\LoansController::class,'ReinstateLoan']);
	

	// view active accounts by the loan officer
	Route::get('/apply/accounts',[App\Http\Controllers\ClientsController::class,'view_client_accounts']);

	// display account creation form by the loan officer
	Route::get('/apply/accounts/new/',[App\Http\Controllers\ClientsController::class,'index']);

	// register a new client by the loan officer
	Route::post('/apply/accounts/new/',[App\Http\Controllers\ClientsController::class,'create_client_account']);

	Route::get('/apply/accounts/applications/',[App\Http\Controllers\ClientsController::class,'view_inactive_new_client_accounts']);

	Route::post('/apply/accounts/applications/{id}',[App\Http\Controllers\ClientsController::class,'activate_new_client_account']);

	Route::get('/apply/admin/accounts',[App\Http\Controllers\ClientsController::class,'view_client_accounts']);
	Route::get('/apply/admin/ind/accounts',[App\Http\Controllers\ClientsController::class,'adminViewIndividualAccounts']);
	Route::get('/apply/admin/grp/accounts',[App\Http\Controllers\ClientsController::class,'adminViewGroupAccounts']);

	Route::get('/admin/download/collateral/{file}', function ($file='') {
    	return response()->file(storage_path('app/public/'.$file));
	});

	Route::get('/apply/documents/receipts/{id}',[App\Http\Controllers\DomPdfController::class,'createReceipt']);

});

