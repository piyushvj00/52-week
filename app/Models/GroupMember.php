<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'has_received',
        'payout_order',
        'user_id',
        'group_id',
    ];
    public function member(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function group(){
        return $this->belongsTo(Group::class,'group_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}


}
