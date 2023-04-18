<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Services\CompanyService;
use App\Services\JobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyJobController extends Controller
{
    /**
     * All company's published job 
     * 
     */
    public function index(CompanyService $companyService)
    {
        return new JsonResponse(
            data: [
                'message' => 'Company\'s jobs',
                'jobs' => JobResource::collection($companyService->getJobs())
            ],
        );
    }

    /**
     * Show company's job
     * 
     * @param Job $job
     */
    public function show(Request $request,Job $job)
    {
        if ($request->user()->cannot('viewCompanyJob', $job)) {
            throw new CustomForbiddenException();
        }
        return new JsonResponse(
            data: [
                'job' => new JobResource($job)
            ]
        );
    }
}
