<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseInfo extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'firstname',
    'middlename',
    'lastname',
    'employer_or_business_name',
    'employer_or_business_address'
  ];

  public function personalInfos()
  {
    return $this->hasMany(PersonalInfo::class, 'spouse_info');
  }
}
