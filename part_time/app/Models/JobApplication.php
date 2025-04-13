<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'job_offer_id', 'status', 'cover_letter', 'resume'];


    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }


    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }


}
