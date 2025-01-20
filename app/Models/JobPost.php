<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'company_logo',
        'company_name',
        'salary_range',
        'location',
        'job_description',
        'work_type',
        'category_id',
        'status',
    ];

    /**
     * Relationship with Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship with JobApplication
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
