<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model {
	use HasFactory;
	protected $fillable = ['id_loan', 'deadline', 'instalment'];
}
