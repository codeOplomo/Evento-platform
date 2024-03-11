<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            $slug = Str::slug($category->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }

}
