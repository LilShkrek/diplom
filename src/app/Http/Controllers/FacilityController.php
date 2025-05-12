<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacilityRequest;
use App\Models\Employee;
use App\Models\Facility;
use Inertia\Inertia;
use Inertia\Response;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('employee')->latest()->paginate(10);
        return Inertia::render('Facility/Index', compact('facilities'));
    }

    public function create()
    {
        $employees = Employee::all();
        return Inertia::render('Facility/Create', compact('employees'));
    }

    public function store(FacilityRequest $request)
    {
        Facility::create($request->validated());
        return redirect()->route('facility.index')->with('success', 'Оборудование создано!');
    }

    public function show(Facility $facility)
    {
        return Inertia::render('Facility/Show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $employees = Employee::all();
        return Inertia::render('Facility/Edit', compact('facility', 'employees'));
    }

    public function update(FacilityRequest $request, Facility $facility)
    {
        $facility->update($request->validated());
        return redirect()->route('facility.index')->with('success', 'Оборудование обновлено!');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect()->route('facility.index')->with('success', 'Оборудование удалено!');
    }


    //TODO:: НАПИСАТЬ МЕТОД ДОБАВЛЕНИЯ СОТРУДНИКА, ЛИЦЕНЗИИ СДЕЛАТЬ МЕТОД ДОБАВЛЕНИЯ ОБОРУДОВАНИЯ
}
