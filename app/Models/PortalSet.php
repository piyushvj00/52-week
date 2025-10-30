<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
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

    public function groups()
    {
        return $this->hasMany(Group::class, 'portal_set_id');
    }
}
