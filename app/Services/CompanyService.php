<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyService
{
    /** 
     * Global access for $user
     **/
    public $user;

    public function __construct()
    {
        /** @var \App\Models\User $user  */
        $user = auth()->user();
        $this->user = $user;
    }

    public function createCompanyForUser(array $companyData)
    {
        if (!$this->companyExistsForUser($this->user->id)) {
            $company = new Company();
            $company->fill($companyData);
            /** Attach a profile (COMPANY) to the user **/
            $this->user->company()->save($company);
            return $company;
        }
        return false;
    }

    public function updateCompanyForUser(array $companyData)
    {
        $company = $this->companyExistsForUser();
        if ($company) {
            $company->update([
                ...$companyData,
                'brand' => $companyData['brand'] ? $companyData['brand'] : $company->brand
            ]);
            return $company;
        }
        return false;
    }

    /**
     * Store company brand
     **/
    public function uploadBrand($brand): string
    {
        if ($brand) {
            $brandName = $brand->hashName();
            $brandPath = $brand->storeAs('uploads/company-brand', $brandName, 'public');
            return '/storage/' . $brandPath;
        }
        return '';
    }

    /**
     * Verify if user has already a company profile
     **/
    private function companyExistsForUser()
    {
        return Company::where('user_id', $this->user->id)->first();
    }
}