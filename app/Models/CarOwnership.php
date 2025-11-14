<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOwnership extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'status',
    'monthly_amortization',
    'vehicle_type',
    'year_acquired',
    'financing_institution',
    'loan_term'
  ];
}
