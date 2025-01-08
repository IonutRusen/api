<?php

namespace App\Http\Controllers\v1\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($companyId)
    {
        $comp = Company::find($companyId);
        $comp->delete();
       return response()->json(['message' => 'Company deleted successfully'], 200);
    }
}
