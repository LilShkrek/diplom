<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Licence;
//use Inertia\Inertia;
//use Inertia\Response;
//
//class LicenceController extends Controller
//{
//    const MODEL_CLASS = Licence::class;
//
//    public function show(): Response
//    {
//        return Inertia::render('Dashboard');
//    }
//}


namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Licence;
use App\Http\Requests\LicenceRequest;
use Inertia\Inertia;

class LicenceController extends Controller
{
    // Список лицензий
    public function index()
    {
        $licences = Licence::with('facility')->latest()->paginate(10);
        return Inertia::render('Licence/Index', compact('licences'));
    }

    // Форма создания
    public function create()
    {
        $facilities = Facility::all();
        return Inertia::render('Licence/Create', compact('facilities'));
    }

    // Сохранение
    public function store(LicenceRequest $request)
    {
        Licence::create($request->validated());
        return redirect()->route('licence.index')->with('success', 'Лицензия создана!');
    }

    // Просмотр
    public function show(Licence $licence)          // TODO:: добавить просмотр каждой лицензии отдельно (аналогично остальным сущностям)
    {
        return Inertia::render('Licence/Show', compact('licence'));
    }

    // Форма редактирования
    public function edit(Licence $licence)
    {
        $facilities = Facility::all();
        return Inertia::render('Licence/Edit', compact('licence', 'facilities'));
    }

    // Обновление
    public function update(LicenceRequest $request, Licence $licence)
    {
        $licence->update($request->validated());
        return redirect()->route('licence.index')->with('success', 'Лицензия обновлена!');
    }

    // Удаление
    public function destroy(Licence $licence)
    {
        $licence->delete();
        return redirect()->route('licence.index')->with('success', 'Лицензия удалена!');
    }
}
