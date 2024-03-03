<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Relation avec le modèle Event.
     * Une catégorie peut avoir plusieurs événements.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
