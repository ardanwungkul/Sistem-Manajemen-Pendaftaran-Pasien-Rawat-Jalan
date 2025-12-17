<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Poly;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $selectedPatient = null;
        $data = collect();

        if ($request->filled('patient_id')) {
            $data = Visit::where('patient_id', $request->patient_id)
                ->latest()
                ->paginate(10);
        }

        return view('master.visit.index', compact('data', 'selectedPatient'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->has('search_patient')) {
            $patients = Patient::where('name', 'LIKE', '%' . $request->search_patient . '%')
                ->orWhere('nik', 'LIKE', '%' . $request->search_patient . '%')
                ->limit(10)
                ->get();

            $results = $patients->map(function ($patient) {
                return [
                    'id'   => $patient->id,
                    'name' => $patient->name,
                    'nik'  => $patient->nik,
                    'text' => $patient->nik . ' - ' . $patient->name,
                ];
            });

            return response()->json([
                'results' => $results,
                'pagination' => [
                    'more' => false
                ]
            ]);
        }

        if ($request->has('poly_id')) {
            $doctor = Doctor::where('poly_id', $request->poly_id)->get();

            return response()->json($doctor);
        }

        $poly = Poly::all();
        return view('master.visit.create', compact('poly'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'visit_date' => 'required',
            'poly_id' => 'required',
            'doctor_id' => 'required',
            'complaint' => 'required'
        ]);

        $visit = new Visit();
        $visit->patient_id = $request->patient_id;
        $visit->visit_date = $request->visit_date;
        $visit->department = Poly::find($request->poly_id)->name;
        $visit->doctor_name = Doctor::find($request->doctor_id)->name;
        $visit->doctor_id = $request->doctor_id;
        $visit->complaint = $request->complaint;
        $visit->save();

        return redirect()
            ->route('visit.index')
            ->with(['success' => 'Data berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Visit $visit)
    {
        if ($request->has('search_patient')) {
            $patients = Patient::where('name', 'LIKE', '%' . $request->search_patient . '%')
                ->orWhere('nik', 'LIKE', '%' . $request->search_patient . '%')
                ->limit(10)
                ->get();

            $results = $patients->map(function ($patient) {
                return [
                    'id'   => $patient->id,
                    'name' => $patient->name,
                    'nik'  => $patient->nik,
                    'text' => $patient->nik . ' - ' . $patient->name,
                ];
            });

            return response()->json([
                'results' => $results,
                'pagination' => [
                    'more' => false
                ]
            ]);
        }

        if ($request->has('poly_id')) {
            $doctor = Doctor::where('poly_id', $request->poly_id)->get();

            return response()->json($doctor);
        }

        $poly = Poly::all();
        return view('master.visit.edit', compact('poly', 'visit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'patient_id' => 'required',
            'visit_date' => 'required',
            'poly_id' => 'required',
            'doctor_id' => 'required',
            'complaint' => 'required'
        ]);

        $visit->patient_id = $request->patient_id;
        $visit->visit_date = $request->visit_date;
        $visit->department = Poly::find($request->poly_id)->name;
        $visit->doctor_name = Doctor::find($request->doctor_id)->name;
        $visit->doctor_id = $request->doctor_id;
        $visit->complaint = $request->complaint;
        $visit->save();

        return redirect()
            ->route('visit.index')
            ->with(['success' => 'Data berhasil diubah.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()
            ->route('visit.index')
            ->with(['success' => 'Data berhasil dihapus.']);
    }
}
