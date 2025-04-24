<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    //protected $fillable = ['name', 'email', 'password'];
    protected $fillable = ['title', 'price', 'description','instructor','thumbnail','material','video'];
    //protected $fillable = ['user_id', 'course_id', 'price', 'certificate','status'];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_enrolls', 'course_id', 'user_id')->withPivot('price', 'certificate', 'status');
    }
}
