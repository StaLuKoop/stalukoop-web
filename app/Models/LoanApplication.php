<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'personal_info',
        'employment_info',
        'loan_info',
        'loan_security'
    ];

    public function personal()
    {
        return $this->belongsTo(PersonalInfo::class, 'personal_info');
    }

    public function employment()
    {
        return $this->belongsTo(LaEmploymentInfo::class, 'employment_info');
    }

    public function info()
    {
        return $this->belongsTo(LoanInfo::class, 'loan_info');
    }

    public function security()
    {
        return $this->belongsTo(LoanSecurity::class, 'loan_security');
    }
}
