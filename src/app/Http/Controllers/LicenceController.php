<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Licence;
use App\Http\Requests\LicenceRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class LicenceController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Licence::with('facility');

        // Поиск по названию
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Сортировка
        $sort = $request->get('sort', 'created_at'); // по умолчанию сортировка по дате создания
        $direction = $request->get('direction', 'desc');

        // Проверка допустимых полей сортировки
        $allowedSorts = ['name', 'key', 'buy_date', 'start_date', 'end_date', 'facility_id', 'created_at'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        $query->orderBy($sort, $direction);

        // Пагинация
        $licences = $query->paginate(10)->withQueryString();

        return Inertia::render('Licence/Index', [
            'licences' => $licences,
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }



    public function create()
    {
        $this->authorize('create', Licence::class);

        $facilities = Facility::all();
        return Inertia::render('Licence/Create', compact('facilities'));
    }

    public function store(LicenceRequest $request)
    {
        $this->authorize('create', Licence::class);

        Licence::create($request->validated());
        return redirect()->route('licence.index')->with('success', 'Лицензия создана!');
    }

    public function show(Licence $licence)
    {
        $this->authorize('view', $licence);

        return Inertia::render('Licence/Show', compact('licence'));
    }

    public function edit(Licence $licence)
    {
        $this->authorize('update', $licence);

        $facilities = Facility::all();
        return Inertia::render('Licence/Edit', compact('licence', 'facilities'));
    }

    public function update(LicenceRequest $request, Licence $licence)
    {
        $this->authorize('update', $licence);

        $licence->update($request->validated());
        return redirect()->route('licence.index')->with('success', 'Лицензия обновлена!');
    }

    public function destroy(Licence $licence)
    {
        $this->authorize('delete', $licence);

        $licence->delete();
        return redirect()->route('licence.index')->with('success', 'Лицензия удалена!');
    }

    public function export()
    {
        $this->authorize('viewAny', Licence::class);

        $licences = Licence::with('facility')->get();

        $csv = "Название,Ключ,Дата покупки,Начало действия,Окончание действия,Оборудование\n";

        foreach ($licences as $licence) {
            $csv .= "{$licence->name},{$licence->key},{$licence->buy_date},{$licence->start_date},{$licence->end_date}," . ($licence->facility->name ?? '—') . "\n";
        }

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="licences.csv"',
        ]);
    }
}
