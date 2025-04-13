<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'job_title', 'hourly_rate', 'available_hours', 'skills', 'experience', 'city', 'country', 'cv_path', 'image_path', 'is_active', 'phone'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
