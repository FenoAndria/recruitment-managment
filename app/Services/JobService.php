<?php

namespace App\Services;

use App\Exceptions\CustomForbiddenException;
use App\Models\Job;
use App\Models\User;

class JobService
{
    /** 
     * Global access for $user
     **/
    public $user;

    public function __construct()
    {
        /** @var \App\Models\User $user  */
        $user = auth()->user();
        $this->user = $user;
    }

    public function createJob(array $jobData): Job
    {
        $job = new Job();
        $job->fill([
            ...$jobData,
            'company_id' => $this->user->company->id,
        ]);
        $job->save();
        return $job;
    }

    public function updateJob(Job $job, array $jobData)
    {
        $job->update($jobData);
        return $job;
        // Error : Boolean column cannot be null
    }

    public function deleteJob(Job $job)
    {
        return $job->delete();
    }

    public function listJob()
    {
        // Only job owner can see job with visibility false ???
        // job->visibility || (!job->visibility && job->company == user->company)
        return Job::where('visibility', true)
            ->orWhere(function ($query) {
                $query->where('visibility', false)
                    ->where('company_id', auth()->user()->company->id);
            })
            ->get();
    }
}
