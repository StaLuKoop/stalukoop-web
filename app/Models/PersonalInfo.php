<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'firstname',
    'middlename',
    'lastname',
    'gender',
    'civil_status',
    'nationality',
    'no_of_dependents',
    'date_of_birth',
    'place_of_birth',
    'religion',
    'parent_info',
    'spouse_info',
    'contact_info',
    'gov_id',
    'monthly_expenses',
    'employment_info',
    'home_addresses',
    'slpmc_relative',
    'private_property',
    'membership_payment'
  ];

  public function parents()
  {
    return $this->belongsTo(ParentInfo::class, 'parent_info');
  }

  public function spouse()
  {
    return $this->belongsTo(SpouseInfo::class, 'spouse_info');
  }

  public function contact()
  {
    return $this->belongsTo(ContactInfo::class, 'contact_info');
  }

  public function govId()
  {
    return $this->belongsTo(GovId::class, 'gov_id');
  }

  public function expenses()
  {
    return $this->belongsTo(MonthlyExpense::class, 'monthly_expenses');
  }

  public function employment()
  {
    return $this->belongsTo(EmploymentInfo::class, 'employment_info');
  }

  public function addresses()
  {
    return $this->belongsTo(HomeAddress::class, 'home_addresses');
  }

  public function relative()
  {
    return $this->belongsTo(SlpmcRelative::class, 'slpmc_relative');
  }

  public function property()
  {
    return $this->belongsTo(PrivateProperty::class, 'private_property');
  }

  public function membershipPayment()
  {
    return $this->belongsTo(MembershipPayment::class, 'membership_payment');
  }

  public function familyMembers()
  {
    return $this->hasMany(FamilyMember::class, 'client_id');
  }

  public function loanApplications()
  {
    return $this->hasMany(LoanApplication::class, 'personal_info');
  }
}
