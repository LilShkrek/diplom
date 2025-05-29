<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacilityRequest;
use App\Models\Employee;
use App\Models\Facility;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FacilityController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Facility::with('employee');

        // Фильтрация по запросу
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        // Сортировка
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        if (in_array($sortColumn, ['name', 'status', 'inventory_num', 'buy_date', 'operation_end_date'])) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        return Inertia::render('Facility/Index', [
            'facilities' => $query->paginate(10)->withQueryString(),
            'filters' => $request->only('search'),
            'sort' => [
                'column' => $sortColumn,
                'direction' => $sortDirection,
            ],
            'employees' => Employee::all(['id', 'name']),
        ]);
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

        $facility->load('employee');
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
