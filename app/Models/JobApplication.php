<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cv',
        'job_post_id',
        'status',
        'is_seen',
    ];
    protected $appends = ['cv_url'];


    /**
     * Relationship with JobPost
     */
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function getCvUrlAttribute()
    {
        return asset('storage/' . $this->cv);
    }



}
