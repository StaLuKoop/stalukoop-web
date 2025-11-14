<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
  use HasFactory;

  protected $primaryKey = 'fam_id';
  public $incrementing = false;
  protected $keyType = 'string';

  protected $fillable = [
    'name',
    'gender',
    'relationship',
    'marital_status',
    'educational_attainment',
    'occupation',
    'client_id'
  ];

  public function client()
  {
    return $this->belongsTo(PersonalInfo::class, 'client_id');
  }
}
