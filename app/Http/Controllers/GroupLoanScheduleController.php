<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupLoanScheduleController extends Controller
{
    public function index(){
        
        return view('apply.settings.loan_groups.loan_group_activity_schedule');
    }
}


// SELECT l.*,g.group_name FROM loans l left join clients c on l.id_client=c.id left join loan_groups g on c.id_loan_group=g.id where l.loan_status='running' ORDER BY c.id_loan_group asc