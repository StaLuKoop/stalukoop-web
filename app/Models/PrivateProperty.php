<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateProperty extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'car_ownership',
    'house_and_lot'
  ];

  public function car()
  {
    return $this->belongsTo(CarOwnership::class, 'car_ownership');
  }

  public function house()
  {
    return $this->belongsTo(HouseAndLot::class, 'house_and_lot');
  }
}
