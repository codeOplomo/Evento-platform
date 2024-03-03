<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'status', 'number_of_tickets'];

    /**
     * Relation avec le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le modèle Event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
