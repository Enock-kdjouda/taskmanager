<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'priority', 'status', 'due_date', 'user_id', 'project_id'
    ];
    protected $casts = [
        'due_date' => 'datetime',
    ];
    

    // Relation avec l'utilisateur (une tâche est assignée à un utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le projet (une tâche appartient à un projet)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
