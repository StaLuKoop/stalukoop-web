<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentHome extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'present_home_address',
    'housing_status',
    'monthly_rent',
    'months_of_renting'
  ];
}
