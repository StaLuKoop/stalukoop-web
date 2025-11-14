<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PmesCertificate extends Model
{
  use HasFactory;

  protected $fillable = [
    'attendee_id',
    'certificate_number',
    'file_path',
    'issued_by',
    'issued_at',
  ];

  public function attendee()
  {
    return $this->belongsTo(PmesAttendee::class);
  }

  public function admin()
  {
    return $this->belongsTo(User::class, 'issued_by');
  }
}
