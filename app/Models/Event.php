<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Définir les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'title', 'description', 'event_date', 'location', 'category_id', 'organizer_id',
    ];


    protected $casts = [
        'event_date' => 'datetime',
    ];

    // Relation avec l'organisateur (un utilisateur)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function bookedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookings');
    }


    // Relation avec la catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // In Event.php model
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
