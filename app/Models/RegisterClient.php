<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterClient extends Model {
	use HasFactory;
	protected $fillable = ['name', 'telephone', 'gender', 'marital_status', 'work_place', 'occupation', 'district', 'resident_village', 'resident_parish', 'resident_division', 'resident_district', 'next_of_kin', 'id_group', 'id_member', 'dob', 'house_head','account_status', 'ever_borrowed_loan', 'loan_amount_borrowed', 'loan_amount_borrowed_words', 'loan_lending_institution', 'registered_by', 'registration_date'];
}
