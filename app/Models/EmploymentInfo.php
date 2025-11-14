<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentInfo extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'employment_type',
    'employer_or_business_name',
    'employer_or_business_address'
  ];
}
