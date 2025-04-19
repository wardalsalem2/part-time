<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['company_id', 'job_offer_id', 'user_id', 'message', 'is_read'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function jobOffer() {
        return $this->belongsTo(JobOffer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
