<?php

namespace App\Services;

use App\Models\Candidature;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class CandidatureService
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

    public function getCandidaturesForCompany()
    {
        // candidature where job.company == user.company
        $candidatures = Job::has('candidature')->where('company_id', $this->user->company->id)->get();
        return $candidatures;
    }

    public function getCandidaturesByCandidate()
    {
        // candidature where candidate == user.candidate
        $candidatures = $this->user->candidate->candidature;
        return $candidatures;
    }

    public function storeCandidature(Job $job): Candidature
    {
        return Candidature::create([
            'job_id' => $job->id,
            'candidate_id' => $this->user->candidate->id,
        ]);
    }

    public function updateCandidature(Candidature $candidature, $status): Candidature
    {
        $candidature->update(
            [
                'status' => $status
            ]
        );
        return $candidature;
    }

    /**
     * Check candidature for candidates
     **/
    public function candidatureExistsForCandidate(Job $job)
    {
        return Candidature::where([
            'job_id' => $job->id,
            'candidate_id' => $this->user->candidate->id,
        ])->first();
    }
}
