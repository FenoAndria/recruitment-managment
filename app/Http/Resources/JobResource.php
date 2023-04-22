<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'title' => $this->title,
            'published_at' => $this->published_at,
            'deadline' => $this->deadline,
            'description' => $this->description,
            'missions' => $this->missions,
            'profile_required' => $this->profile_required,
            'urgent' => $this->urgent,
            // 'visibility' => $this->visibility,
            'company' => new CompanyResource($this->company),
            // 'candidatures' =>($this->candidature),
        ];
    }
}
