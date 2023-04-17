<?php

namespace App\Services;

use App\Models\Candidate;

class CandidateService
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

    public function getCandidate()
    {
        $candidate = $this->candidateExistsForUser();
        return $candidate;
    }

    /**
     * Verify if user has already a candidate profile
     **/
    private function candidateExistsForUser()
    {
        return Candidate::where('user_id', $this->user->id)->first();
    }
}
