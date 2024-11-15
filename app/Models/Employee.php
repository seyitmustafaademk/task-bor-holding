<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $guarded = [];
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'position',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

}
