<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\InterviewRequest;
use App\Models\Candidature;
use App\Services\InterviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    
    public function store(InterviewRequest $request, InterviewService $interviewService, Candidature $candidature)
    {
        if ($request->user()->cannot('storeInterview', $candidature)) {
            throw new CustomForbiddenException();
        }
        if ($interview = $interviewService->interviewExists($candidature)) {
            return new JsonResponse(
                data: [
                    'message' => 'Interview already planned!',
                    'interview' => $interview
                ],
                status: 500
            );
        } else {
            $interview = $interviewService->storeInterview($candidature, $request->validated());
            return new JsonResponse(
                data: [
                    'message' => 'Interview saved!',
                    'interview' => $interview
                ],
                status: 201
            );
        }
    }
}
