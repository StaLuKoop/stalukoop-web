<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanInfo extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'loan_amount',
        'loan_term',
        'loan_type',
        'share_capital',
        'savings',
        'membership_type',
        'payment_method'
    ];

    public function application()
    {
        return $this->hasOne(LoanApplication::class, 'loan_info');
    }
}
