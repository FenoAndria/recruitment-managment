<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InterviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'candidature' => [
                'job_title' => $this->candidature->job->title,
                'candidate_name' => $this->candidature->candidate->first_name.' '.$this->candidature->candidate->last_name,
                'company_name' => $this->candidature->job->company->name,
                'status' => $this->candidature->status,
            ],
            'date' => $this->date,
            'time' => $this->time,
            'details' => $this->details,
        ];
    }
}
