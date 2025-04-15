<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'description', 'work_hours', 'salary', 'location', 'requirements', 'deadline', 'is_active', 'category'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite_jobs')->withTimestamps();
    }
}
