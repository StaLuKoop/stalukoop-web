<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaEmploymentInfo extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'empployer_or_business_name',
    'empployer_or_business_address',
    'type_of_employment',
    'income_level'
  ];

  public function application()
  {
    return $this->hasOne(LoanApplication::class, 'employment_info');
  }
}
