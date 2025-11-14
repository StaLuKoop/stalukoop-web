<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyExpense extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'food',
    'electric_bill',
    'credit_card',
    'water_bill',
    'cable_or_internet',
    'tuition_fee',
    'others'
  ];
}
