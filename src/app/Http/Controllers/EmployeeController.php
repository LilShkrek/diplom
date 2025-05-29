<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Employee::query();

        // Поиск по фамилии
        if ($request->filled('search')) {
            $query->where('surname', 'like', '%' . $request->search . '%');
        }

        // Сортировка
        $sort = $request->get('sort', 'created_at'); // по умолчанию сортировка по дате создания
        $direction = $request->get('direction', 'desc');

        // Разрешённые поля сортировки
        $allowedSorts = ['name', 'surname', 'patronymic', 'position', 'service_number', 'created_at'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        $query->orderBy($sort, $direction);

        // Пагинация
        $employees = $query->paginate(10)->withQueryString();

        return Inertia::render('Employee/Index', [
            'employees' => $employees,
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }



    public function create()
    {
        $this->authorize('create', Employee::class);

        return Inertia::render('Employee/Create');
    }

    public function store(EmployeeRequest $request)
    {
        $this->authorize('create', Employee::class);

        Employee::create($request->validated());
        return redirect()->route('employee.index')->with('success', 'Оборудование создано!');
    }

    public function show(Employee $employee)
    {
        $this->authorize('view', $employee);

        return Inertia::render('Employee/Show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);

        return Inertia::render('Employee/Edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $this->authorize('update', $employee);

        $employee->update($request->validated());
        return redirect()->route('employee.index')->with('success', 'Оборудование обновлено!');
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);

        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Оборудование удалено!');
    }
}
