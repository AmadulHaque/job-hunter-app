<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $jobPosts = JobPost::with('category')
            ->where('status', 'active')
            ->latest()
            ->get()
            ->groupBy('category_id');

        // Structure the response
        $response = $jobPosts->map(function ($jobs, $categoryId) {
            $categoryName = $jobs->first()->category->name ?? 'Unknown Category'; // Get category name

            return [
                'category_id' => $categoryId,
                'category_name' => $categoryName,
                'jobs' => $jobs->map(function ($job) {
                    // `position`, `company_logo`, `company_name`, `salary_range`, `location`, `job_description`, `work_type`
                    return [
                        'id' => $job->id,
                        'position' => $job->position,
                        'company_name' => $job->company_name,
                        'company_logo' => "filse/".$job->company_logo,
                        'job_description' => $job->job_description,
                        'location' => $job->location,
                        'salary_range' => $job->salary_range,
                        'work_type' => $job->work_type,
                    ];
                })->values(), // Ensure the job collection is re-indexed
            ];
        })->values();

        return success("Job Post",$response);
    }


    public function jobApply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:20',
            'cv'            => 'required|file|mimes:pdf|max:10240',
            'job_post_id'   => 'required|exists:job_posts,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return validationError('Validation failed.', $validator->errors());
        }
        try {
            // Store the CV file
            $cvPath = $request->file('cv')->store('cvs', 'public');

            // Create the job application record
            $application = JobApplication::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'cv' =>  $cvPath,
                'job_post_id' => $request->job_post_id,
                'status' => 'pending', // Default status
            ]);
            return success("Application submitted successfully!",$application);
        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return failure('An error occurred',$e->getMessage());
        }
    }
}



