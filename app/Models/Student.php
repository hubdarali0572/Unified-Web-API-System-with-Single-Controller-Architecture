<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'first_name', 'last_name', 'father_name', 'email', 'dob'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
