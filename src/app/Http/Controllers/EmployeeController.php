<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return Inertia::render('Employee/Index', compact('employees'));
    }

    public function create()
    {
        return Inertia::render('Employee/Create');
    }

    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employee.index')->with('success', 'Оборудование создано!');
    }

    public function show(Employee $employee)
    {
        return Inertia::render('Employee/Show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return Inertia::render('Employee/Edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employee.index')->with('success', 'Оборудование обновлено!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Оборудование удалено!');
    }
}
