<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
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
    public function index()
    {
        $jobs = Job::where('visibility', true)->get();
        return JobResource::collection($jobs);
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
    public function show(Job $job)
    {
        return new JsonResponse(
            data: [
                'job' => $job
            ],
            status: 201
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
        try {
            $jobUpdate = $jobService->updateJob($job, $request->all());
            return new JsonResponse(
                data: [
                    'message' => 'Job updated successfully!',
                    'job' => new JobResource($jobUpdate),
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
     * Remove the specified resource from storage.
     *
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobService $jobService, Job $job)
    {
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
