<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovId extends Model
{
  use HasFactory;

  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'type',
    'details'
  ];
}
