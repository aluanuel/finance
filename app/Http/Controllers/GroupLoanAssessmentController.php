<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\LoanApplication;
use \App\Models\RegisterClient;
use \App\Models\GroupLoanAssessment;
use \App\Models\Guarantors;
use \App\Models\LoanSecurity;
use \App\Models\LoanWitness;
use \App\Models\LoanSchedule;
use Carbon\Carbon;
use DB;
use Auth;

class GroupLoanAssessmentController extends Controller
{
    public function index(Request $request){
    	$cont = DB::table('loan_applications')
			->join('register_clients','loan_applications.id_client','register_clients.id')
			->join('client_groups','loan_applications.id_group','client_groups.id')
			->select('client_groups.group_name','client_groups.group_code','register_clients.name','register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation','register_clients.district','register_clients.resident_village', 'register_clients.work_place', 'register_clients.occupation','register_clients.resident_parish', 'register_clients.work_place', 'register_clients.occupation','register_clients.resident_division', 'register_clients.work_place', 'register_clients.occupation','register_clients.resident_district','register_clients.dob','register_clients.next_of_kin','register_clients.house_head','loan_applications.*')
			->where('loan_applications.id','=',$request->id)
			->first();
		$interest = DB::table('interest_on_loans')
			->where('loan_type','=','Group')
			->latest()
			->first();
    	return view('apply.grp.assess.index',compact('cont','interest'));
    }

    public function fillAssessment(Request $request){
    	$loan = LoanApplication::find($request->id);
    	$id_client = $loan->id_client;
    	$client = RegisterClient::find($loan->id_client);
    	$client->name = request('name');
    	$client->gender = request('gender');
    	$client->marital_status = request('marital_status');
    	$client->telephone = request('telephone');
    	$client->work_place = request('work_place');
    	$client->occupation = request('occupation');
    	$client->district = request('district');
    	$client->resident_village = request('resident_village');
    	$client->resident_parish = request('resident_parish');
    	$client->resident_division = request('resident_division');
    	$client->resident_district = request('resident_district');
    	$client->house_head = request('house_head');
    	$client->save();

    	$group = new GroupLoanAssessment();

    	$group->id_loan = $loan->id;
    	$group->id_client = $loan->id_client;
    	$group->business_type = request('business_type');
    	$group->business_owner = request('business_owner');
        $group->business_location = request('business_location');
        $group->loan_user = request('loan_user');
        $group->present_investment = request('present_investment');
        $group->present_profit = request('present_profit');
        $group->monthly_expenditure = request('monthly_expenditure');
        $group->capital_source = request('capital_source');
        $group->present_inventory = request('present_inventory');
        $group->cash_at_hand = request('cash_at_hand');
        $group->fixed_assets = request('fixed_assets');
        $group->sales_seven_days = request('sales_seven_days');
        $group->member_location = request('member_location');
        $group->known_person_name = request('known_person_name');
        $group->known_person_telephone = request('known_person_telephone');
        $group->credit_officer = Auth::user()->id;
        $group->save();

        $witness_name = request('witness_name');
        $witness_relationship = request('witness_relationship');
        $witness_on = request('witness_on');

        foreach ($witness_name as $key => $value) {
            $witness = array(
                "id_loan" => $request->id,
                "id_client" => $loan->id_client,
                "witness_name" => $witness_name[$key],
                "witness_relationship" => $witness_relationship[$key],
                "witness_on" => $witness_on[$key],
            );
            LoanWitness::insert($witness);
        }

        $guarantor_name = request('guarantor_name');
        $guarantor_address = request('guarantor_address');
        $guarantor_telephone = request('guarantor_telephone');

        foreach ($guarantor_name as $key => $value) {

            $guarantors = array(
                "id_loan" => $request->id,
                "id_client" => $loan->id_client,
                "guarantor_name" => $guarantor_name[$key],
                "guarantor_address" => $guarantor_address[$key],
                "guarantor_telephone" => $guarantor_telephone[$key],
            );
            Guarantors::insert($guarantors);
        }
            $security_name = request('security_name');
            $security_number = request('security_number');
            $security_value = request('security_value');
            $security_attachment = request('security_attachment');

        foreach ($security_name as $key => $value) {

                $request->validate(['security_attachment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', ]);
                $imageName = time().'.'.$request->security_attachment[$key]->extension();
                $request->security_attachment->move(public_path('docs/collateral'), $imageName);
                $securityAttached = array(
                    "id_client" => $loan->id_client,
                    "id_loan" => $request->id,
                    "security_name" => $security_name[$key],
                    "security_number" => $security_number[$key],
                    "security_value" => $security_value[$key],
                    "security_attachment" => $imageName,
                );
                LoanSecurity::insert($securityAttached);
        }

        $loan->proposed_amount = request('proposed_amount');
        $loan->loan_period = request('loan_period');
        $loan->borrowing_purpose = request('borrowing_purpose');
        $loan->assessment_status = 0;
        $loan->save();

    	return redirect()->route('OfficerViewGroupApplications')->with('success','Recorded successfully');
    }

    public function viewAssessment(){
        $approve = DB::table('loan_applications')
            ->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
            ->join('client_groups','client_groups.id','loan_applications.id_group')
            ->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','client_groups.group_code','client_groups.group_name')
            ->where('register_clients.id_group','!=',NULL)
            ->where('loan_applications.approval_status', '=', NULL)
            ->where('loan_applications.assessment_status', '=', '0')->orderBy('loan_applications.created_at', 'desc')->get();
        $approved = DB::table('loan_applications')
            ->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
            ->join('client_groups','client_groups.id','loan_applications.id_group')
            ->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','client_groups.group_code','client_groups.group_name')
            ->where('register_clients.id_group','!=',NULL)
            ->where('loan_applications.approval_status', '=', 1)
            ->where('loan_applications.assessment_status', '=', 1)->orderBy('loan_applications.created_at', 'desc')->get();
        $cancelled = DB::table('loan_applications')
            ->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
            ->join('client_groups','client_groups.id','loan_applications.id_group')
            ->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','client_groups.group_code','client_groups.group_name')
            ->where('register_clients.id_group','!=',NULL)
            ->where('loan_applications.approval_status', '=', 0)
            ->where('loan_applications.assessment_status', '=', 0)->orderBy('loan_applications.created_at', 'desc')->get();
        return view('apply/grp/assess/assess',compact('approve','approved','cancelled'));
    }

    public function adminViewAssessment(){
        $loan = DB::table('loan_applications')
            ->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
            ->join('client_groups','client_groups.id','loan_applications.id_group')
            ->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','client_groups.group_name','client_groups.group_code')
            ->where('register_clients.id_group','!=',NULL)
            ->where('loan_applications.proposed_amount', '!=', NULL)
            ->where('loan_applications.assessment_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

        $approve = DB::table('loan_applications')
            ->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
            ->join('client_groups','client_groups.id','loan_applications.id_group')
            ->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','client_groups.group_name','client_groups.group_code')
            ->where('register_clients.id_group','!=',NULL)
            ->where('loan_applications.approval_status', '=', NULL)
            ->where('loan_applications.assessment_status', '=', '0')->orderBy('loan_applications.created_at', 'desc')->get();

        $approved = DB::table('loan_applications')
            ->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
            ->join('client_groups','client_groups.id','loan_applications.id_group')
            ->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','client_groups.group_name','client_groups.group_code')
            ->where('register_clients.id_group','!=',NULL)
            ->where('loan_applications.approval_status', '=', '1')
            ->where('loan_applications.assessment_status', '=', '1')
            ->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();
        $cancelled = DB::table('loan_applications')
            ->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
            ->join('client_groups','client_groups.id','loan_applications.id_group')
            ->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone','client_groups.group_name','client_groups.group_code')
            ->where('register_clients.id_group','!=',NULL)
            ->where('loan_applications.approval_status', '=', '0')
            ->where('loan_applications.assessment_status', '=', '0')->orderBy('loan_applications.created_at', 'desc')->get();
        return view('apply.admin.grp.assess',compact('loan','approve', 'approved', 'cancelled'));
    }

    public function adminViewAssessmentSingle(Request $request){
        $cont = DB::table('loan_applications')
                ->join('register_clients','register_clients.id','loan_applications.id_client')
                ->join('client_groups','client_groups.id','register_clients.id_group')
                ->join('group_loan_assessments','group_loan_assessments.id_loan','loan_applications.id')
                ->where('loan_applications.id','=',$request->id)
                ->select('client_groups.group_name','client_groups.group_code','register_clients.name','register_clients.gender','register_clients.marital_status','register_clients.telephone','register_clients.work_place','register_clients.occupation','register_clients.district','register_clients.resident_village','register_clients.resident_parish','register_clients.resident_division','register_clients.resident_district','register_clients.house_head','loan_applications.*','group_loan_assessments.business_type','group_loan_assessments.business_location','group_loan_assessments.business_owner','group_loan_assessments.loan_user','group_loan_assessments.present_investment','group_loan_assessments.present_profit','group_loan_assessments.present_inventory','group_loan_assessments.monthly_expenditure','group_loan_assessments.cash_at_hand','group_loan_assessments.fixed_assets','group_loan_assessments.capital_source','group_loan_assessments.sales_seven_days','group_loan_assessments.member_location','group_loan_assessments.known_person_name','group_loan_assessments.known_person_telephone')
                ->first();
        $security = LoanSecurity::where('id_loan','=',$request->id)
                    ->get();
        $guarantors = Guarantors::where('id_loan','=',$request->id)
                    ->get();
        $witnesses = LoanWitness::where('id_loan','=',$request->id)
                    ->get();
        return view('apply.admin.grp.single',compact('cont','security','guarantors','witnesses'));
    }

    public function adminFillAssessmentForm(Request $request){

        $loan = LoanApplication::find($request->id);

        if ($loan) {

            $loan->approval_status = $this->approveLoan(request('assessment_status'));

            $recommended_amount = request('recommended_amount');

            $security = (0.3 * $recommended_amount);

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

            $instalment = round(($total_loan / $loan_period), 2);

            $data = array();

            $today = Carbon::now();

            for ($x = 1; $x <= $loan_period; $x++) {

                $data[] = array('id_loan' => $request->id,
                    'instalment' => $instalment,
                    'deadline' => $today->toDateString(),
                );
                $today = $today->addDays(7);
            }
            LoanSchedule::insert($data);

            return redirect()->route('AdminGroupAssessment')->with('success', 'Assessment recorded successfully');
        }


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
