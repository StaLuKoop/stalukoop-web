<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAddress extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'permanent_home',
    'present_home'
  ];

  public function permanent()
  {
    return $this->belongsTo(PermanentHome::class, 'permanent_home');
  }

  public function present()
  {
    return $this->belongsTo(PresentHome::class, 'present_home');
  }
}
