<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{

    public function index(Request $request)
    {
        $query = Company::with('user');
        
        Log::info('Request Parameters:', $request->all());
    
        // Filter by name if provided
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
            Log::info('Filtering by name:', ['name' => $request->name]);
        }
        
        // Handle status filter
        if ($request->has('status') && $request->status !== 'All statuses') {
            $status = $request->status === '1' ? true : false; // Convert status to boolean (if needed)
            $query->where('is_active', $status);
            Log::info('Filtering by status:', ['status' => $status]);
        } else {
        
            Log::info('No status filter applied, returning all companies');
        }
        $companies = $query->paginate(10)->appends($request->all());
        
        // Log the generated SQL query and bindings
        Log::info('Generated SQL Query:', ['query' => $query->toSql()]);
        Log::info('Query Bindings:', ['bindings' => $query->getBindings()]);
        
        // Log the number of companies returned
        Log::info('Companies Count:', ['count' => $companies->count()]);
        
            return view('admin.companies.index', compact('companies'));
    }
    
    
    
    //------------------------------------------------------------------------------------------------------------

    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.show', compact('company'));
    }

    //------------------------------------------------------------------------------------------------------------

    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }


    //-------------------------------------------------------------------------------------------------------------

    public function update(Request $request, string $id)
    {
        $company = Company::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'industry' => 'nullable|string',
            'website' => 'nullable|url',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'num_employees' => 'nullable|integer',
        ]);
    

        $company->update($request->only([
            'name',
            'description',
            'industry',
            'website',
            'phone',
            'email',
            'address',
            'city',
            'num_employees',
        ]));
    
        return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully');
    }
    
    //-------------------------------------------------------------------------------------------------------------


    public function destroy($id)                //soft delete
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('admin.companies.index')->with('success', 'Company deleted');
    }


    //----------------------------------- for approving company --------------------------------------------------------------------------

    public function approve($id)
    {
        $company = Company::findOrFail($id);
        $company->is_active = true;
        $company->save();
        return redirect()->route('admin.companies.index')->with('success', 'Company approved');
    }

    //-----------------------------------for disable company-----------------------------------------------------------------

    public function disable($id)
    {
        $company = Company::findOrFail($id);
        $company->is_active = false;
        $company->save();
        return redirect()->route('admin.companies.index')->with('success', 'Company disabled');
    }

}
