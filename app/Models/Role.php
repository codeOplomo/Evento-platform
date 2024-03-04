<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Assuming you might want to retrieve all users associated with a role

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
