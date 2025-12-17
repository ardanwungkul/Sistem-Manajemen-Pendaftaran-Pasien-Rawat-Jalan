<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Poly;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $data = Doctor::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        })
            ->orderBy('name', 'asc')
            ->paginate(20)
            ->withQueryString();

        return view('master.doctor.index', compact('data'));
    }

    public function create()
    {
        $poly = Poly::all();
        return view('master.doctor.create', compact('poly'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name'        => 'required|string|max:50',
                'poly_id'         => 'required',
            ],
        );

        Doctor::create($validated);

        return redirect()
            ->route('doctor.index')
            ->with(['success' => 'Data berhasil disimpan.']);
    }

    public function edit(Doctor $doctor)
    {
        $poly = Poly::all();
        return view('master.doctor.edit', compact('poly', 'doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate(
            [
                'name'        => 'required|string|max:50',
                'poly_id'         => 'required',
            ],
        );

        $doctor->update($validated);

        return redirect()
            ->route('doctor.index')
            ->with(['success' => 'Data berhasil diubah.']);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()
            ->route('doctor.index')
            ->with(['success' => 'Data berhasil dihapus.']);
    }
}
