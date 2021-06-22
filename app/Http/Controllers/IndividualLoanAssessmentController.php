<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadFile;
use \App\Models\Guarantors;
use \App\Models\IndividualLoanAssessment;
use \App\Models\LoanApplication;
use \App\Models\LoanSchedule;
use \App\Models\LoanSecurity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidatePassword;

class IndividualLoanAssessmentController extends Controller {

	public function index() {

		$loan = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone')
			->where('loan_applications.proposed_amount', '!=', NULL)
			->where('loan_applications.application_by',Auth::user()->id)
			->where('loan_applications.assessment_status', '=', NULL)
			->where('register_clients.id_group',NULL)
			->orderBy('loan_applications.created_at', 'desc')->get();

		$approve = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone')
			->where('register_clients.id_group',NULL)
			->where('loan_applications.approval_status', '=', NULL)
			->where('loan_applications.assessment_status', '=', '0')
			->where('loan_applications.application_by',Auth::user()->id)
			->orderBy('loan_applications.created_at', 'desc')->get();

		$approved = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('register_clients.id_group',NULL)
			->where('loan_applications.loan_status', '=', NULL)
			->where('loan_applications.application_by',Auth::user()->id)
			->orderBy('loan_applications.created_at', 'desc')->get();
		$cancelled = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone')
			->where('loan_applications.approval_status', '=', '0')
			->where('register_clients.id_group',NULL)
			->where('loan_applications.application_by',Auth::user()->id)
			->where('loan_applications.assessment_status', '=', '0')
			->orderBy('loan_applications.created_at', 'desc')->get();

		return view('apply.ind.assess.index', compact('loan','approve', 'approved', 'cancelled'));
	}

	public function adminViewLoan() {

		$loan = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','register_clients.id_group')
			->where('loan_applications.proposed_amount', '!=', NULL)
			->where('register_clients.id_group',NULL)
			->where('loan_applications.assessment_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

		$approve = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','register_clients.id_group')
			->where('loan_applications.approval_status', '=', NULL)
			->where('register_clients.id_group',NULL)
			->where('loan_applications.assessment_status', '=', '0')->orderBy('loan_applications.created_at', 'desc')->get();

		$approved = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','register_clients.id_group')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('register_clients.id_group',NULL)
			->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();
		$cancelled = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','register_clients.id_group')
			->where('register_clients.id_group',NULL)
			->where('loan_applications.approval_status', '=', '0')
			->where('loan_applications.assessment_status', '=', '0')->orderBy('loan_applications.created_at', 'desc')->get();

		return view('apply.admin.ind.assess', compact('loan','approve', 'approved', 'cancelled'));
	}

	public function viewAssessmentForm(Request $request) {

		$loan_id = $loan = LoanApplication::find($request->id);

		$cont = DB::table('register_clients')
			->join('loan_applications', 'loan_applications.id_client', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation', 'register_clients.district', 'register_clients.resident_village', 'register_clients.resident_parish', 'register_clients.resident_division', 'register_clients.resident_district', 'register_clients.next_of_kin')
			->where('loan_applications.id', '=', $loan_id->id)
			->latest()
			->first();

		return view('apply.ind.assess.ind', compact('cont'));
	}

	public function assessIndividual(Request $request) {
		$loan_id = $loan = LoanApplication::find($request->id);

		$cont = DB::table('register_clients')
			->join('loan_applications', 'loan_applications.id_client', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone')
			->where('loan_applications.id', '=', $loan_id->id)
			->first();
		return view('apply.ind.assess.fill', compact('cont'));
	}

	public function adminAssessIndividual(Request $request) {
		$loan_id = $loan = LoanApplication::find($request->id);

		$cont = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->join('individual_loan_assessments', 'loan_applications.id', 'individual_loan_assessments.id_loan')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'individual_loan_assessments.applicant_type', 'individual_loan_assessments.business_type', 'individual_loan_assessments.monthly_income', 'individual_loan_assessments.income_sources', 'individual_loan_assessments.monthly_income_others', 'individual_loan_assessments.total_monthly_income', 'individual_loan_assessments.food', 'individual_loan_assessments.rent', 'individual_loan_assessments.medical', 'individual_loan_assessments.electricity', 'individual_loan_assessments.school_fees', 'individual_loan_assessments.leisure', 'individual_loan_assessments.others', 'individual_loan_assessments.total_monthly_expense', 'individual_loan_assessments.monthly_surplus', 'individual_loan_assessments.borrowed_money', 'individual_loan_assessments.start_date', 'individual_loan_assessments.end_date', 'individual_loan_assessments.money_lender', 'individual_loan_assessments.amount_borrowed', 'individual_loan_assessments.loan_period_borrowed', 'individual_loan_assessments.monthly_instalment', 'individual_loan_assessments.other_personal_loan', 'individual_loan_assessments.money_lender_personal', 'individual_loan_assessments.amount_outstanding', 'individual_loan_assessments.running_project', 'individual_loan_assessments.project_name', 'individual_loan_assessments.project_budget', 'individual_loan_assessments.monthly_project_expense')
			->where('loan_applications.id', '=', $loan_id->id)
			->first();
		$assess = DB::table('individual_loan_assessments')
			->select('*')
			->where('id', '=', $loan_id->id)
			->first();
		$security = DB::table('loan_securities')
			->select('*')
			->where('id_loan', '=', $loan_id->id)
			->get();
		$guarantors = DB::table('guarantors')
			->select('*')
			->where('id_loan', '=', $loan_id->id)
			->get();
		return view('apply.admin.ind.fill', compact('cont', 'assess', 'security', 'guarantors'));
	}

	public function FillAssessmentForm(Request $request) {
		$validator = $request->validate([
			    'password' => ['required', new ValidatePassword(auth()->user())]
			]);

		dd($request->validate(['security_attachment.*' => 'required|string|image|mimes:jpeg,png,jpg,gif,svg|max:2048']));

		try {

			$assess = new IndividualLoanAssessment();
			$assess->id_client = request('id_client');
			$assess->id_loan = $request->id;
			$assess->applicant_type = request('applicant_type');
			$assess->business_type = request('business_type');
			$assess->monthly_income = request('monthly_income');
			$assess->income_sources = request('income_sources');
			$assess->monthly_income_others = request('monthly_income_others');
			$assess->total_monthly_income = request('total_monthly_income');
			$assess->food = request('food');
			$assess->rent = request('rent');
			$assess->medical = request('medical');
			$assess->electricity = request('electricity');
			$assess->school_fees = request('school_fees');
			$assess->leisure = request('leisure');
			$assess->others = request('others');
			$assess->total_monthly_expense = request('total_monthly_expense');
			$assess->monthly_surplus = request('monthly_surplus');
			$assess->borrowed_money = request('borrowed_money');
			$assess->start_date = request('start_date');
			$assess->end_date = request('end_date');
			$assess->money_lender = request('money_lender');
			$assess->amount_borrowed = request('amount_borrowed');
			$assess->loan_period_borrowed = request('loan_period_borrowed');
			$assess->monthly_instalment = request('monthly_instalment');
			$assess->other_personal_loan = request('other_personal_loan');
			$assess->money_lender_personal = request('money_lender_personal');
			$assess->amount_outstanding = request('amount_outstanding');
			$assess->running_project = request('running_project');
			$assess->project_name = request('project_name');
			$assess->project_budget = request('project_budget');
			$assess->monthly_project_expense = request('monthly_project_expense');
			$assess->recorded_by = Auth::id();
			$assess->save();

			//$security_name = request('security_name');
			$security_value = request('security_value');
			$security_attachment = request('security_attachment');

			foreach ($request->file('security_name') as $security_name) {

				$file = $security_name;
    			$file->move('docs/collateral', $file->getClientOriginalName());

    			dd($file);
				$securityAttached = array(
					"id_client" => request('id_client'),
					"id_loan" => $request->id,
					"security_name" => $file->getClientOriginalName(),
					"security_value" => $security_value[$key],
					"security_attachment" => $imageName,
				);
				LoanSecurity::insert($securityAttached);
			}

			$guarantor_name = request('guarantor_name');
			$guarantor_address = request('guarantor_address');
			$guarantor_telephone = request('guarantor_telephone');

			foreach ($guarantor_name as $key => $value) {

				$guarantors = array(
					"id_loan" => $request->id,
					"id_client" => request('id_client'),
					"guarantor_name" => $guarantor_name[$key],
					"guarantor_address" => $guarantor_address[$key],
					"guarantor_telephone" => $guarantor_telephone[$key],
				);
				Guarantors::insert($guarantors);
			}

			$loan = LoanApplication::find($request->id);
			$loan->assessment_status = 0;
			$loan->save();

			return redirect()->route('assessSingle')->with('success', 'Assessment successful');

		} catch (Exception $e) {

			return redirect()->route('assessSingle')->with('error', 'Error in recording data');
		}
	}

	public function AdminFillAssessmentForm(Request $request) {

		$loan = LoanApplication::find($request->id);

		if ($loan) {

			$loan->approval_status = $this->approveLoan(request('assessment_status'));

			$recommended_amount = request('recommended_amount');

			$security = $this->checkRecommendedAmount($recommended_amount);

			$loan->recommended_amount = $recommended_amount;

			$interest_rate = request('interest_rate');

			$interest = ($interest_rate / 100) * $recommended_amount;

			$total_loan = $interest + $recommended_amount;

			$loan->total_loan = $total_loan;

			$loan->interest_rate = $interest_rate;

			$loan->loan_interest = $interest;

			$loan->security = $security;

			$loan->loan_amount_issued = $this->calculateLoanToIssue($recommended_amount, $security);

			$loan_period = request('loan_period');

			$loan->loan_period = $loan_period;

			$loan->assessment_status = request('assessment_status');

			$loan->recommended_by = Auth::id();

			$loan->save();

			//$schedule = new LoanSchedule();

			$instalment = round(($total_loan / $loan_period), 2);

			$data = array();

			$today = Carbon::now();

			$today = $today->addDays(30);

			for ($x = 1; $x <= $loan_period; $x++) {

				$data[] = array('id_loan' => $request->id,
					'instalment' => $instalment,
					'deadline' => $today->toDateString(),
				);
				$today = $today->addDays(30);
			}
			LoanSchedule::insert($data);

			return redirect()->route('adminAssessSingle')->with('success', 'Assessment recorded successfully');
		}
	}

	protected function checkRecommendedAmount($recommended_amount) {

		$security = NULL;

		if ($recommended_amount > 6000000) {

			$security = 0.1 * $recommended_amount;
		}

		return $security;
	}

	protected function calculateLoanToIssue($recommended_amount, $security) {
		$issue = $recommended_amount;

		if ($security != NULL) {

			$issue = $recommended_amount - $security;

		}

		return $issue;
	}

	protected function approveLoan($assessment_status) {
		$approve = 1;

		if ($assessment_status == 0) {

			$approve = 0;
		}
		return $approve;
	}

}
