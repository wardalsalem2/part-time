<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id', 'name', 'description', 'industry', 'website', 'phone', 'email', 'address', 'city', 'num_employees', 'is_active'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
}
