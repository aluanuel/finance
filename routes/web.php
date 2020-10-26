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
	Route::get('/apply/ind', [App\Http\Controllers\RegisterClientController::class, 'singleApplication'])->name('viewSingle');
	Route::get('/apply/settings/members/{id}', [App\Http\Controllers\RegisterClientController::class, 'ViewGroupMembers']);
	Route::post('/apply/ind', [App\Http\Controllers\RegisterClientController::class, 'NewIndividualApplication']);

	Route::get('/apply/view/ind', [App\Http\Controllers\LoanApplicationController::class, 'viewIndividualApplication'])->name('tellerSingleViewApplications');
	Route::get('/apply/view/ind/processed', [App\Http\Controllers\LoanApplicationController::class, 'viewIndividualProcessedLoan'])->name('tellerSingleProcessedLoans');

	Route::post('/apply/ind/{id}', [App\Http\Controllers\RegisterClientController::class, 'updateIndividualApplication']);
	Route::post('/apply/ind/cont/{id}', [App\Http\Controllers\LoanApplicationController::class, 'continueIndividualApplication']);
	Route::post('/apply/ind/update/{id}', [App\Http\Controllers\LoanApplicationController::class, 'updateIndividualApplication']);
	Route::get('/apply/ind/assess', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'index'])->name('assessSingle');
	Route::get('/apply/admin/ind/assess', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'adminViewLoan'])->name('adminAssessSingle');
	Route::post('/apply/ind/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'viewAssessmentForm']);
	Route::get('/apply/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'assessIndividual']);
	Route::get('/apply/admin/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'adminAssessIndividual']);
	Route::post('/apply/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'FillAssessmentForm']);
	Route::post('/apply/admin/assess/{id}', [App\Http\Controllers\IndividualLoanAssessmentController::class, 'AdminFillAssessmentForm']);

	Route::get('/app/ind/schedule/{id}', [App\Http\Controllers\LoanApplicationController::class, 'individualLoanPaymentSchedule']);
	Route::get('apply/ind/accept/{id}', [App\Http\Controllers\LoanApplicationController::class, 'acceptLoan']);
	Route::get('/apply/view', [App\Http\Controllers\LoanApplicationController::class, 'viewIndividualProcessedLoans']);
	Route::get('/apply/admin/processed', [App\Http\Controllers\LoanApplicationController::class, 'adminViewIndividualProcessedLoans']);
	Route::post('/apply/process/{id}', [App\Http\Controllers\LoanApplicationController::class, 'startIndividualProcessedLoans']);
	Route::get('/apply/settings/interest', [App\Http\Controllers\InterestOnLoanController::class, 'index']);
	Route::post('/apply/settings/interest', [App\Http\Controllers\InterestOnLoanController::class, 'create']);

	Route::get('/apply/trans', [App\Http\Controllers\LoanRepaymentController::class, 'index']);
	Route::get('/apply/trans/{id}', [App\Http\Controllers\LoanRepaymentController::class, 'showPayFormWithLoanSelected']);
	Route::post('/apply/trans', [App\Http\Controllers\LoanRepaymentController::class, 'RecordPayment']);
	Route::post('/apply/trans/search/payment', [App\Http\Controllers\LoanRepaymentController::class, 'SearchPayment']);
	Route::get('/trans/record', [App\Http\Controllers\OtherPaymentController::class, 'index']);
	Route::post('/trans/record', [App\Http\Controllers\OtherPaymentController::class, 'recordTransaction']);
	Route::post('/apply/trans/search/income',[App\Http\Controllers\OtherPaymentController::class,'SearchIncome']);
	Route::post('/apply/trans/search/expense',[App\Http\Controllers\OtherPaymentController::class,'SearchExpense']);
	Route::get('generate/loan/application/{id}', [App\Http\Controllers\PDFController::class, 'CreateLoanApplicationReceipt']);
	Route::get('generate/loan/payment/receipt/{id}', [App\Http\Controllers\PDFController::class, 'CreateLoanPaymentReceipt']);
	Route::get('/apply/view/profile/{id}', [App\Http\Controllers\LoanApplicationController::class, 'viewClientProfile'])->name('clientProfile');
	Route::get('/apply/report/collections',[App\Http\Controllers\ReportController::class,'Collections']);
	Route::get('/apply/report/sales',[App\Http\Controllers\ReportController::class,'Sales']);
	Route::get('/apply/report/incomes',[App\Http\Controllers\ReportController::class,'Incomes']);
	Route::get('/apply/report/expenses',[App\Http\Controllers\ReportController::class,'Expenses']);
	Route::post('/apply/report/incomes/search',[App\Http\Controllers\ReportController::class,'SearchIncome']);
	Route::post('/apply/report/expenses/search',[App\Http\Controllers\ReportController::class,'SearchExpense']);
	Route::get('/apply/settings/groups',[App\Http\Controllers\ClientGroupController::class,'index']);
	Route::post('/apply/settings/groups',[App\Http\Controllers\ClientGroupController::class,'newLoanGroup']);


	Route::get('/apply/grp', [App\Http\Controllers\RegisterClientController::class, 'showGroupApplicationForm']);
	Route::post('/apply/grp',[App\Http\Controllers\RegisterClientController::class, 'NewGroupApplication']);

	Route::get('/apply/settings/users', [App\Http\Controllers\SystemUserController::class, 'index']);
	Route::post('/apply/settings/user', [App\Http\Controllers\SystemUserController::class, 'create']);
	Route::get('apply/user/{id}',[App\Http\Controllers\SystemUserController::class, 'profile']);
	Route::post('apply/user/update/{id}',[App\Http\Controllers\SystemUserController::class, 'updateProfile']);

	Route::get('/apply/settings/appraisal',[App\Http\Controllers\AppraisalFeeController::class, 'index']);
	Route::post('/apply/settings/appraisal',[App\Http\Controllers\AppraisalFeeController::class, 'create']);


	Route::get('/apply/view/grp', [App\Http\Controllers\LoanApplicationController::class, 'viewGroupApplication'])->name('tellerGroupViewApplications');
	Route::get('/apply/grp/assess/{id}',[App\Http\Controllers\GroupLoanAssessmentController::class, 'index']);

});

