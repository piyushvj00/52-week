<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaderBankdetails extends Model
{
    use HasFactory;

    
    protected $table = 'leader_bankdetails';

    protected $fillable = [
        'leader_id',
        'bank_holder_name',
        'bank_name',
        'bank_address',
        'account_number',
        'routing_number',
        'swift_code',
        'account_type',
        'payment_details',
        'portal_set_id',
        'group_id'
    ];

}
