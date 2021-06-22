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
	Route::get('/apply/ind/', [App\Http\Controllers\RegisterClientController::class, 'singleApplication'])->name('viewSingle');

	Route::post('/apply/ind/', [App\Http\Controllers\RegisterClientController::class, 'NewIndividualApplication']);

	Route::get('/apply/ind/assess', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'index'])->name('assessSingle');

	Route::get('/apply/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'assessIndividual']);

	Route::post('/apply/ind/cont/{id}', [App\Http\Controllers\LoanApplicationController::class, 'continueIndividualApplication']);

	Route::get('/apply/wiew/loan_list/{id}',[App\Http\Controllers\RegisterClientController::class, 'ViewClientLoanList'])->name('viewLoanList');

	Route::get('/apply/grp/processed',[App\Http\Controllers\LoanApplicationController::class, 'adminViewGroupProcessedLoans']);
	Route::get('/apply/ind/processed', [App\Http\Controllers\LoanApplicationController::class, 'adminViewIndividualProcessedLoans']);

/******************************** Teller ************************************/
	Route::get('/apply/teller/ind/application/', [App\Http\Controllers\LoanApplicationController::class, 'viewIndividualApplication'])->name('tellerSingleViewApplications');

	Route::get('/apply/teller/ind/processed/', [App\Http\Controllers\LoanApplicationController::class, 'viewIndividualProcessedLoans']);

	Route::get('/apply/teller/grp/application/', [App\Http\Controllers\LoanApplicationController::class, 'viewGroupApplication'])->name('tellerGroupViewApplications');

	Route::get('/apply/teller/grp/processed/', [App\Http\Controllers\LoanApplicationController::class, 'viewGroupProcessedLoans']);

	Route::post('/apply/teller/ind/{id}', [App\Http\Controllers\RegisterClientController::class, 'updateIndividualApplication']);

	Route::post('/apply/teller/process/{id}', [App\Http\Controllers\LoanApplicationController::class, 'startIndividualProcessedLoans']);

	Route::get('/apply/teller/trans', [App\Http\Controllers\LoanRepaymentController::class, 'index'])->name('loanPaymentForm');

	Route::get('/apply/teller/trans/{id}', [App\Http\Controllers\LoanRepaymentController::class, 'showPayFormWithLoanSelected']);

	Route::get('/apply/teller/trans/security/{id}', [App\Http\Controllers\LoanApplicationController::class, 'ReturnLoanSecurity']);

	Route::post('/apply/teller/trans', [App\Http\Controllers\LoanRepaymentController::class, 'RecordPayment']);

	Route::post('/apply/teller/trans/search/payment', [App\Http\Controllers\LoanRepaymentController::class, 'SearchPayment']);

	Route::get('/apply/teller/savings/', [App\Http\Controllers\ClientSavingController::class, 'savingsForm']);

	Route::post('/apply/teller/savings/', [App\Http\Controllers\ClientSavingController::class, 'Deposit']);

	Route::get('/apply/teller/withdrawal/', [App\Http\Controllers\ClientSavingController::class, 'withdrawalForm']);

	Route::post('/apply/teller/withdrawal/', [App\Http\Controllers\ClientSavingController::class, 'Withdrawal']);




	Route::get('/apply/settings/members/{id}', [App\Http\Controllers\RegisterClientController::class, 'ViewGroupMembers']);
	Route::post('/apply/settings/members/{id}', [App\Http\Controllers\RegisterClientController::class, 'updateGroupMemberRole']);


	Route::get('/apply/view/ind/processed', [App\Http\Controllers\LoanApplicationController::class, 'viewIndividualProcessedLoan'])->name('tellerSingleProcessedLoans');
	
	
	Route::post('/apply/ind/update/{id}', [App\Http\Controllers\LoanApplicationController::class, 'updateIndividualApplication']);

	Route::get('/apply/admin/ind/', [App\Http\Controllers\LoanApplicationController::class, 'adminViewIndividualApplication']);
	Route::get('/apply/admin/ind/assess', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'adminViewLoan'])->name('adminAssessSingle');
	Route::post('/apply/ind/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'viewAssessmentForm']);
	
	Route::get('/apply/admin/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'adminAssessIndividual']);
	Route::post('/apply/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'FillAssessmentForm']);
	Route::post('/apply/admin/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'AdminFillAssessmentForm']);
	Route::get('/apply/admin/collateral/{id}',[App\Http\Controllers\LoanSecurityController::class, 'index']);
	Route::post('/apply/admin/collateral/{id}',[App\Http\Controllers\LoanSecurityController::class, 'issueSecurity']);
	Route::get('/app/ind/schedule/{id}', [App\Http\Controllers\LoanApplicationController::class, 'individualLoanPaymentSchedule']);
	Route::get('apply/ind/accept/{id}', [App\Http\Controllers\LoanApplicationController::class, 'acceptLoan']);
	Route::get('/apply/admin/processed', [App\Http\Controllers\LoanApplicationController::class, 'adminViewIndividualProcessedLoans']);

	Route::get('/apply/settings/interest', [App\Http\Controllers\InterestOnLoanController::class, 'index']);
	Route::post('/apply/settings/interest', [App\Http\Controllers\InterestOnLoanController::class, 'create']);
	Route::get('/apply/settings/interest/defaulting', [App\Http\Controllers\InterestOnLoanOutstandingController::class, 'index']);
	Route::post('/apply/settings/interest/defaulting', [App\Http\Controllers\InterestOnLoanOutstandingController::class, 'create']);


	Route::get('/trans/record', [App\Http\Controllers\OtherPaymentController::class, 'index']);
	Route::post('/trans/record', [App\Http\Controllers\OtherPaymentController::class, 'recordTransaction']);
	Route::post('/apply/trans/search/income',[App\Http\Controllers\OtherPaymentController::class,'SearchIncome']);
	Route::post('/apply/trans/search/expense',[App\Http\Controllers\OtherPaymentController::class,'SearchExpense']);

/***************************pdf documents********************************/
	Route::get('/generate/loan/application/{id}', [App\Http\Controllers\PDFController::class, 'CreateLoanApplicationReceipt']);
	Route::get('/generate/loan/payment/receipt/{id}', [App\Http\Controllers\PDFController::class, 'CreateLoanPaymentReceipt']);
	Route::get('/generate/account/statement/{id}', [App\Http\Controllers\PDFController::class, 'CreateAccountStatement']);
	Route::get('/generate/report/accounts', [App\Http\Controllers\PDFController::class, 'CreateAccountsReport']);
	Route::get('/generate/report/collections', [App\Http\Controllers\PDFController::class, 'CreateCollectionsReport']);
	Route::get('/generate/report/expenses', [App\Http\Controllers\PDFController::class, 'CreateExpensesReport']);
	Route::get('/generate/report/incomes', [App\Http\Controllers\PDFController::class, 'CreateIncomesReport']);
	Route::get('/generate/report/cashbook', [App\Http\Controllers\PDFController::class, 'CreateCashBookReport']);


	Route::get('/apply/view/profile/{id}', [App\Http\Controllers\LoanApplicationController::class, 'viewClientProfile'])->name('clientProfile');

	Route::get('/apply/account/profile/{id}', [App\Http\Controllers\RegisterClientController::class, 'viewAccountDetails'])->name('accountDetails');

	/**********************************Reports******************************************/
	Route::get('/apply/report/collections',[App\Http\Controllers\ReportController::class,'Collections']);
	Route::get('/apply/report/collections/repayment',[App\Http\Controllers\ReportController::class,'LoanRepayments']);
	Route::get('/apply/report/collections/security',[App\Http\Controllers\ReportController::class,'LoanSecurity']);

	Route::get('/apply/report/sales',[App\Http\Controllers\ReportController::class,'Sales']);
	Route::get('/apply/report/incomes',[App\Http\Controllers\ReportController::class,'Incomes']);
	Route::get('/apply/report/expenses',[App\Http\Controllers\ReportController::class,'Expenses']);
	Route::get('/apply/report/cbook',[App\Http\Controllers\ReportController::class,'CashBook']);
	Route::get('/apply/report/bsht',[App\Http\Controllers\ReportController::class,'BalanceSheet']);
	Route::post('/apply/report/incomes/search',[App\Http\Controllers\ReportController::class,'SearchIncome']);
	Route::post('/apply/report/expenses/search',[App\Http\Controllers\ReportController::class,'SearchExpense']);


	/*******************************settings************************************/
	Route::get('/apply/settings/groups',[App\Http\Controllers\ClientGroupController::class,'index']);
	Route::post('/apply/settings/groups',[App\Http\Controllers\ClientGroupController::class,'newLoanGroup']);
	Route::get('/apply/grp/list',[App\Http\Controllers\ClientGroupController::class,'view']);
	Route::post('/apply/grp/list',[App\Http\Controllers\ClientGroupController::class,'newMemberRole']);


	Route::get('/apply/grp', [App\Http\Controllers\RegisterClientController::class, 'showGroupApplicationForm'])->name('OfficerViewGroupApplications');
	Route::post('/apply/grp',[App\Http\Controllers\RegisterClientController::class, 'NewGroupApplication']);

	Route::get('/apply/settings/users', [App\Http\Controllers\SystemUserController::class, 'index']);
	Route::post('/apply/settings/user', [App\Http\Controllers\SystemUserController::class, 'create']);
	Route::get('/apply/settings/manage', [App\Http\Controllers\SystemUserController::class, 'manageUser']);
	Route::get('apply/user/{id}',[App\Http\Controllers\SystemUserController::class, 'profile']);
	Route::post('/apply/user/update/{id}',[App\Http\Controllers\SystemUserController::class, 'updatePassword']);
	Route::post('/apply/user/update/photo/{id}',[App\Http\Controllers\SystemUserController::class, 'updateUserPhoto']);

	Route::get('/apply/settings/appraisal/',[App\Http\Controllers\AppraisalFeeController::class, 'index']);
	Route::post('/apply/settings/appraisal/',[App\Http\Controllers\AppraisalFeeController::class, 'create']);
	Route::get('/apply/settings/processing/',[App\Http\Controllers\LoanProcessingFeeController::class, 'index']);
	Route::post('/apply/settings/processing/',[App\Http\Controllers\LoanProcessingFeeController::class, 'create']);


	
	Route::get('/apply/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'index']);
	Route::post('/apply/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'fillAssessment']);
	Route::get('/apply/grp/assess',[App\Http\Controllers\GroupLoanAssessmentController::class, 'viewAssessment']);
	Route::get('/apply/admin/grp/',[App\Http\Controllers\LoanApplicationController::class, 'adminViewGroupApplications']);
	Route::get('/apply/admin/grp/assess',[App\Http\Controllers\GroupLoanAssessmentController::class, 'adminViewAssessment'])->name('AdminGroupAssessment');
	Route::get('/apply/admin/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'adminViewAssessmentSingle']);
	Route::post('/apply/admin/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'adminFillAssessmentForm']);
	Route::get('/apply/admin/grp/processed',[App\Http\Controllers\LoanApplicationController::class, 'adminViewGroupProcessedLoans']);
	Route::get('/apply/admin/reinstate/{id}',[App\Http\Controllers\LoanApplicationController::class,'ReinstateLoan']);
	
	Route::get('/apply/accounts',[App\Http\Controllers\RegisterClientController::class,'viewAccounts']);
	Route::get('/apply/admin/accounts',[App\Http\Controllers\RegisterClientController::class,'adminViewAccounts']);


});

