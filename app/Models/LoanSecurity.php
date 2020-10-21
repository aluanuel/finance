<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSecurity extends Model {
	use HasFactory;
	protected $fillable = ['id_client', 'id_loan', 'security_name', 'security_value', 'security_attachment'];
}
