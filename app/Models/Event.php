<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // Définir les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'title', 'description', 'event_date', 'end_date', 'location', 'capacity', 'is_approved', 'is_auto', 'category_id', 'organizer_id',
    ];


    protected $casts = [
        'event_date' => 'datetime',
        'end_date' => 'datetime',
        'is_approved' => 'boolean',
        'is_auto' => 'boolean',
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
