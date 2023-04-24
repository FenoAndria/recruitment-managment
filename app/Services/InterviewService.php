<?php

namespace App\Services;

use App\Models\Candidature;
use App\Models\Interview;

class InterviewService
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

    public function storeInterview(Candidature $candidature, array $interviewData): Interview|false
    {
        $interview = new Interview();
        $interview->fill([
            'date' => $interviewData['date'],
            'time' => $interviewData['time'],
            'candidature_id' => $candidature->id,
            'details' => $interviewData['details'] ?? ''
        ]);
        $interview->save();
        return $interview;
    }

    public function interviewExists(Candidature $candidature)
    {
        return Interview::where('candidature_id', $candidature->id)->first();
    }
}
