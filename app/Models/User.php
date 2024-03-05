<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        return $this->hasMany(Event::class, 'organizer_id'); // Assurez-vous que 'organizer_id' est le nom de la clé étrangère dans la table des événements
    }

    public function bookedEvents()
    {
        return $this->belongsToMany(Event::class, 'bookings');
    }

    // In User.php model
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    public function isClient()
    {
        return $this->roles->contains('name', 'client');
    }



}
