<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{


    public function index(Request $request)
    {
        $query = Company::with('user');
    
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }
    
        $companies = $query->paginate(10)->appends($request->all());
    
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
