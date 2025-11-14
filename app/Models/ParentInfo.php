<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentInfo extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'mother',
    'father',
  ];

  public function motherInfo()
  {
    return $this->belongsTo(MotherInfo::class, 'mother');
  }

  public function fatherInfo()
  {
    return $this->belongsTo(FatherInfo::class, 'father');
  }
}
