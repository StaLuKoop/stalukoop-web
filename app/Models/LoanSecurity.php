<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSecurity extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'provide_collateral_for_loan',
    'collateral_type',
    'collateral_value',
    'collateral_document',
    'updated_collateral_document',
    'savings_intended_for',
    'member_health_condition_affect_loan_status'
  ];

  public function application()
  {
    return $this->hasOne(LoanApplication::class, 'loan_security');
  }
}
