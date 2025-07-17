<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'cdv_number',
    'membership_status',
    'activity_status',
    'date_of_birth',
    'place_of_birth',
    'gender',
    'civil_status',
    'religion',
    'nationality',
    'dependents',
    'present_address',
    'permanent_address',
    'mobile_no',
  ];

  /**
   * Relationship: Member belongs to User.
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
