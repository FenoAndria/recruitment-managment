<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = auth()->user()->company;
        return response()->json([
            'company' => new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request, CompanyService $companyService)
    {
        try {
            $brand = $companyService->uploadBrand($request->file('brand'));
            $companyData = $request->except('brand') + ['brand' => $brand];
            $company = $companyService->createCompanyForUser($companyData);
            if ($company) {
                return new JsonResponse(
                    data: [
                        'message' => 'Company saved',
                        'company' => $company,
                    ],
                    status: 201
                );
            } else {
                return new JsonResponse(
                    data: ['error' => 'Company have already a profile'],
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\CompanyService  $companyService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyService $companyService)
    {
        try {
            $brand = $companyService->uploadBrand($request->file('brand'));
            $companyData = $request->except('brand') + ['brand' => $brand];
            $company = $companyService->updateCompanyForUser($companyData);
            if ($company) {
                return new JsonResponse(
                    data: [
                        'message' => 'Company updated',
                        'company' => new CompanyResource($company),
                    ]
                );
            } else {
                return new JsonResponse(
                    data: ['error' => 'Company not exists'],
                    status: 500
                );
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
