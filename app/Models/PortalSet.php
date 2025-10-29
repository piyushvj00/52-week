<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalSet extends Model
{
    use HasFactory;
    protected $fillable = [
'name',
'total_portals',
            'target_amount',

'start_date',
'end_date',
    ];
}
