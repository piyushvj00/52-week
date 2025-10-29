<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'portal_set_id',
        'name', 
        'group_number',
        'leader_id',
        'target_amount',
        'current_amount',
        'start_date',
        'end_date',
        'project_name',
        'project_description',
        'logo_path',
        'video_path',
        'invite_link',
        'is_active'
    ];

    // Your relationships here...
    public function portalSet() {
        return $this->belongsTo(PortalSet::class);
    }

    public function leader() {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members() {
        return $this->hasMany(GroupMember::class);
    }
     public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
 

public function chats()
{
    return $this->hasMany(GroupChat::class);
}
}
