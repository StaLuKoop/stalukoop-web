<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PmesAttendee extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'schedule_id',
    'email',
    'contact',
    'goal_answer',
    'coop_meaning_answer',
    'entered_code',
    'status',
    'certificate_issued',
    'attended_at',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function schedule()
  {
    return $this->belongsTo(PmesSchedule::class, 'schedule_id');
  }

  public function certificate()
  {
    return $this->hasOne(PmesCertificate::class, 'attendee_id');
  }
}
