<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRequest;
use App\Http\Requests\CandidateUpdateRequest;
use App\Http\Resources\CandidateResource;
use App\Services\CandidateService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CandidateService $candidateService)
    {
        return new JsonResponse(
            data: [
                'candidate' => $candidateService->getCandidate()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CandidateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request, CandidateService $candidateService)
    {
        try {
            $photo = $candidateService->uploadPhoto($request->file('photo'));
            $resume = $candidateService->uploadResume($request->file('resume'));
            $candidateData = $request->except(['photo','resume']) + ['photo' => $photo, 'resume' => $resume];
            $candidate = $candidateService->createCandidateForUser($candidateData);
            if ($candidate) {
                return new JsonResponse(
                    data: [
                        'message' => 'Candidate saved',
                        'candidate' => new CandidateResource($candidate),
                    ],
                    status: 201
                );
            } else {
                return new JsonResponse(
                    data: ['error' => 'Candidate have already a profile'],
                    status: 500
                );
            }
        } catch (Exception $e) {
            return new JsonResponse(
                data: ['error' => $e->getMessage()],
                status: 500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CandidateUpdateRequest  $request
     * @param  CandidateService  $candidateService
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateUpdateRequest $request, CandidateService $candidateService)
    {
        try {
            $photo = $candidateService->uploadPhoto($request->file('photo'));
            $resume = $candidateService->uploadResume($request->file('resume'));
            $candidateData = $request->except(['photo', 'resume']) + ['photo' => $photo, 'resume' => $resume];
            $candidate = $candidateService->updateCandidateForUser($candidateData);
            if ($candidate) {
                return new JsonResponse(
                    data: [
                        'message' => 'Candidate updated',
                        'candidate' => new CandidateResource($candidate),
                    ]
                );
            } else {
                return new JsonResponse(
                    data: ['error' => 'Candidate not exists'],
                    status: 500
                );
            }
        } catch (Exception $e) {
            return new JsonResponse(
                data: ['error' => $e->getMessage()],
                status: 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
