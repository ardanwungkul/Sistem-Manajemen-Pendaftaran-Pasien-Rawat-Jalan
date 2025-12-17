<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $data = Patient::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('nik', 'like', "%{$keyword}%")
                ->orWhere('phone', 'like', "%{$keyword}%");
        })
            ->orderBy('name', 'asc')
            ->paginate(20)
            ->withQueryString();

        return view('master.patient.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name'        => 'required|string|max:100',
                'nik'         => 'required|max:20|unique:patients,nik',
                'gender'      => 'required|in:L,P',
                'birth_date'  => 'required|date',
                'phone'       => 'required|unique:patients,phone',
                'address'     => 'required|string|max:255',
            ],
        );

        Patient::create($validated);

        return redirect()
            ->route('patient.index')
            ->with(['success' => 'Data berhasil disimpan.']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('master.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate(
            [
                'name'        => 'required|string|max:100',
                'nik'         => 'required|max:20|unique:patients,nik,' . $patient->id,
                'gender'      => 'required|in:L,P',
                'birth_date'  => 'required|date',
                'phone'       => 'required|unique:patients,phone,' . $patient->id,
                'address'     => 'required|string|max:255',
            ]
        );

        $patient->update($validated);
        return redirect()
            ->route('patient.index')
            ->with(['success' => 'Data berhasil disimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()
            ->route('patient.index')
            ->with(['success' => 'Data berhasil dihapus.']);
    }
}
