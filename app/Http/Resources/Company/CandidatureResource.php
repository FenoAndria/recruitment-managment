<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\CandidateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidatureResource extends JsonResource
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
            'candidate' => new CandidateResource($this->candidate),
            'status' => $this->status,
            'date' => $this->created_at,
        ];
    }
}
