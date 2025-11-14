<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PmesSchedule extends Model
{
  use HasFactory;

  protected $fillable = [
    'date',
    'time',
    'mode',
    'available_slots',
    'attendance_code',
    'online_link',
    'created_by',
  ];

  public function attendees()
  {
    return $this->hasMany(PmesAttendee::class, 'schedule_id');
  }

  public function admin()
  {
    return $this->belongsTo(User::class, 'created_by');
  }
}
