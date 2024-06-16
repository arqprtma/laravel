<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'categories_id',
        'task_name',
        'task_description',
        'start_date',
        'due_date',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'shared_tasks');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
