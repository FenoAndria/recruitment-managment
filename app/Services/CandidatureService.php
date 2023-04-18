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

    public function storeCandidature()
    {
        //
    }

    /**
     * Check candidature for candidates
     **/
    private function candidatureExistsForCandidate()
    {
        //
    }
}
