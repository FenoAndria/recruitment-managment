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

    public function getCandidate(): Candidate|null
    {
        $candidate = $this->candidateExistsForUser();
        return $candidate;
    }

    
    public function createCandidateForUser(array $candidateData): Candidate|false
    {
        if (!$this->candidateExistsForUser($this->user->id)) {
            $candidate = new Candidate();
            $candidate->fill($candidateData);
            /** Attach a profile (CANDIDATE) to the user **/
            $this->user->candidate()->save($candidate);
            return $candidate;
        }
        return false;
    }

    public function updateCandidateForUser($candidateData): Candidate|false
    {
        $candidate = $this->candidateExistsForUser();
        if ($candidate) {
            $candidate->update([
                ...$candidateData,
                'photo' => $candidateData['photo'] ? $candidateData['photo'] : $candidate->photo,
                'resume' => $candidateData['resume'] ? $candidateData['resume'] : $candidate->resume,
            ]);
            return $candidate;
        }
        return false;
    }

    /**
     * Store candidate's photo
     **/
    public function uploadPhoto($photo): string
    {
        if ($photo) {
            $photoName = $photo->hashName();
            $photoPath = $photo->storeAs('uploads/candidate-photo', $photoName, 'public');
            return '/storage/' . $photoPath;
        }
        return '';
    }
    /**
     * Store candidate's resume
     * TEMP!!
     * TODO: ... combine two functions [upload]
     **/
    public function uploadResume($resume): string
    {
        if ($resume) {
            $resumeName = $resume->hashName();
            $resumePath = $resume->storeAs('uploads/candidate-resume', $resumeName, 'public');
            return '/storage/' . $resumePath;
        }
        return '';
    }

    /**
     * Check if user has already a candidate profile
     **/
    private function candidateExistsForUser()
    {
        return Candidate::where('user_id', $this->user->id)->first();
    }
}
