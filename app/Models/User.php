<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image',
        'phone',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    // messages sent by the user
    public function ledPortals()
    {
        return $this->hasMany(Group::class, 'leader_id');
    }
    public function memberPortals()
    {
        return $this->belongsToMany(Group::class, 'portal_members', 'user_id', 'portal_id')
            ->withPivot('weekly_commitment', 'total_contributed', 'is_active')
            ->withTimestamps();
    }

    /**
     * Get all contributions made by user
     */
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    /**
     * Check if user is a leader
     */
    public function isLeader()
    {
        return $this->role == 'leader';
    }

    /**
     * Get active led portal
     */
    public function activeLedPortal()
    {
        return $this->ledPortals()->where('is_active', true)->first();
    }
    public function group(){
        return $this->hasOne(Group::class,'leader_id');
    }

}
