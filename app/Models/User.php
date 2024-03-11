<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_banned',
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
    ];


    /**
     * Determine if the user has the given role.
     *
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName): bool
    {
        return $this->roles->contains('name', $roleName);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Relation to Event model
     * Assumes a user can organize multiple events
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function bookedEvents()
    {
        return $this->belongsToMany(Event::class, 'bookings');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    public function isClient()
    {
        return $this->roles->contains('name', 'client');
    }

    public function isOrganizer()
    {
        return $this->roles->contains('name', 'organiser');
    }

}
