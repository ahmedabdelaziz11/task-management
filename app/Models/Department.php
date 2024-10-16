<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function employees()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function scopeWithEmployeeStats($query)
    {
        return $query->withCount('employees')
                    ->withSum('employees', 'salary');
    }
}
