<?php

namespace App\Http\Controllers\API\Candidature;

use App\Exceptions\CustomForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CandidatureUpdateRequest;
use App\Http\Resources\Company\CandidatureResource;
use App\Http\Resources\Company\JobResource;
use App\Models\Candidature;
use App\Services\CandidatureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidatureForCompanyController extends Controller
{

    public function index(CandidatureService $candidatureService)
    {
        return new JsonResponse(
            data: [
                'candidatures' => JobResource::collection($candidatureService->getCandidaturesForCompany())
            ]
        );
    }

    public function show(CandidatureService $candidatureService, Candidature $candidature)
    {
        return new JsonResponse(
            data: [
                'candidature' => new CandidatureResource($candidature)
            ]
        );
    }

    public function update(CandidatureUpdateRequest $request, CandidatureService $candidatureService, Candidature $candidature)
    {
        if ($request->user()->cannot('update', $candidature)) {
            throw new CustomForbiddenException();
        }
        return new JsonResponse(
            data: [
                'message' => 'Candidature updated successfully',
                'candidatures' => new CandidatureResource($candidatureService->updateCandidature($candidature, $request->status))
            ]
        );
    }
}
