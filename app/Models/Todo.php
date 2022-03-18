<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todos';
    protected $fillable = [
        'name', 'description', 'status',  'end_date', 'end_time'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'todo_id');
    }
}
