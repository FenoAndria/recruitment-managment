<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CandidatureUpdateRequest;
use App\Http\Resources\CandidatureResource;
use App\Http\Resources\JobResource;
use App\Models\Candidature;
use App\Models\Job;
use App\Services\CandidatureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{

    public function byCandidate(CandidatureService $candidatureService)
    {
        return new JsonResponse(
            data: [
                'candidatures' => CandidatureResource::collection($candidatureService->getCandidaturesByCandidate())
            ]
        );
    }

    public function storeCandidature(CandidatureService $candidatureService, Job $job)
    {
        return new JsonResponse(
            data: [
                'message' => 'Candidature sended successfully',
                'candidatures' => new CandidatureResource($candidatureService->storeCandidature($job))
            ]
        );
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
