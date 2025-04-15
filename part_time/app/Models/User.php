<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'role_id', 'email', 'password'];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }


    //---------------------------------------------------------------------------------------------
    public function favoriteJobs()
    {
        return $this->belongsToMany(JobOffer::class, 'favorite_jobs')->withTimestamps();
    }



}
