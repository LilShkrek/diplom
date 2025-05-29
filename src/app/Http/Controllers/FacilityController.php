<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacilityRequest;
use App\Models\Employee;
use App\Models\Facility;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Inertia\Inertia;
use Inertia\Response;

class FacilityController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Facility::class);

        $facilities = Facility::with('employee')->latest()->paginate(10);
        return Inertia::render('Facility/Index', compact('facilities'));
    }

    public function create()
    {
        $this->authorize('create', Facility::class);

        $employees = Employee::all();
        return Inertia::render('Facility/Create', compact('employees'));
    }

    public function store(FacilityRequest $request)
    {
        $this->authorize('create', Facility::class);

        Facility::create($request->validated());
        return redirect()->route('facility.index')->with('success', 'Оборудование создано!');
    }

    public function show(Facility $facility)
    {
        $this->authorize('view', $facility);

        return Inertia::render('Facility/Show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $this->authorize('update', $facility);

        $employees = Employee::all();
        return Inertia::render('Facility/Edit', compact('facility', 'employees'));
    }

    public function update(FacilityRequest $request, Facility $facility)
    {
        $this->authorize('update', $facility);

        $facility->update($request->validated());
        return redirect()->route('facility.index')->with('success', 'Оборудование обновлено!');
    }

    public function destroy(Facility $facility)
    {
        $this->authorize('delete', $facility);

        $facility->delete();
        return redirect()->route('facility.index')->with('success', 'Оборудование удалено!');
    }
}
