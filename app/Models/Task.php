<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'employee_id',
    ];

    public function getStatusAttribute($value)
    {
        return ucfirst(str_replace('_', ' ', $value));
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }


    public function manager()
    {
        return $this->hasOneThrough(User::class, User::class, 'id', 'id', 'employee_id', 'manager_id');
    }
}
