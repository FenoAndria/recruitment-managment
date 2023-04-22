<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Services\CandidatureService;
use App\Services\JobService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobService $jobService)
    {
        return new JsonResponse(
            data: [
                'message' => 'Listing job',
                'jobs' => JobResource::collection($jobService->visibleJobs())
            ],
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  JobService  $jobService
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request, JobService $jobService)
    {
        try {
            $job = $jobService->createJob($request->validated());
            return new JsonResponse(
                data: [
                    'message' => 'Job created successfully!',
                    'job' => new JobResource($job)
                ],
                status: 201
            );
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CandidatureService $candidatureService, Job $job)
    {
        /**
         * Determine whether the user can view $job
         */
        if ($request->user()->cannot('view', $job)) {
            throw new CustomForbiddenException();
        }
        return new JsonResponse(
            data: [
                'job' => new JobResource($job),
                'candidature' =>($candidatureService->candidatureExistsForCandidate($job)),
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  JobService  $jobService
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobService $jobService, Job $job)
    {
        /**
         * Determine whether the user can update $job
         */
        if ($request->user()->cannot('update', $job)) {
            throw new CustomForbiddenException();
        }
        try {
            $jobUpdate = $jobService->updateJob($job, $request->all());
            return new JsonResponse(
                data: [
                    'message' => 'Job updated successfully!',
                    'job' => new JobResource($jobUpdate),
                ],
                status: 200
            );
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JobService $jobService, Job $job)
    {
        /**
         * Determine whether the user can delete $job
         */
        if ($request->user()->cannot('delete', $job)) {
            throw new CustomForbiddenException();
        }
        try {
            $jobDelete = $jobService->deleteJob($job);
            return new JsonResponse(
                data: [
                    'data' => $jobDelete,
                    'message' => 'Job deleted successfully!'
                ],
                status: 200
            );
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
