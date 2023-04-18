<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidatureResource;
use App\Http\Resources\JobResource;
use App\Services\CandidatureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{

    public function forCompany(CandidatureService $candidatureService)
    {
        return new JsonResponse(
            data: [
                'candidatures' => JobResource::collection($candidatureService->getCandidaturesForCompany())
            ]
        );
    }

    public function byCandidate(CandidatureService $candidatureService)
    {
        return new JsonResponse(
            data: [
                'candidatures' => CandidatureResource::collection($candidatureService->getCandidaturesByCandidate())
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
