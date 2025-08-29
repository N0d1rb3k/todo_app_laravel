<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoApp extends Model
{
    // The table name can often be inferred by Laravel if it follows conventions (plural, snake_case of the class name)
    // but explicitly defining it is fine.
    protected $table = 'todo_apps';

    // Use $fillable for better security by whitelisting mass-assignable attributes.
    protected $fillable = ['title', 'task'];

    public $timestamps = false;
}
