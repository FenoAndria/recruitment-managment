<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Services\CompanyService;
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
                'jobs' => $companyService->getJobs()
            ],
        );
    }

    /**
     * Show company's job
     * 
     * @param Job $job
     */
    public function show(Job $job)
    {
        //
    }
}
