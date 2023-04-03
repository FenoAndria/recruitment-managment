<?php

namespace App\Services;

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
        $job->fill($jobData);
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
}
