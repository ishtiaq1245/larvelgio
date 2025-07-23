<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenents = Tenant::with('domains')->get();
        return view('tenents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'domain_name' => 'required|string|max:255|unique:domains,domain',
            'password'=> ['required','confirmed',Rules\Password::defaults()],
        ]);
        $tenents = Tenant::create($validateData);
        $tenents->domains()->create([
           'domain'=> $validateData['domain_name'].'.'.config('app.domain')]);

        return redirect()->route('tenents.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
