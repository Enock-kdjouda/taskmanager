<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date'
    ];

    // Relation avec les utilisateurs (un projet peut être attribué à plusieurs utilisateurs)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Relation avec les tâches (un projet peut avoir plusieurs tâches)
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
