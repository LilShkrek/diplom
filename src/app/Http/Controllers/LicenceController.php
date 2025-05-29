<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Licence;
use App\Http\Requests\LicenceRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Inertia\Inertia;

class LicenceController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Licence::class);

        $licences = Licence::with('facility')->latest()->paginate(10);
        return Inertia::render('Licence/Index', compact('licences'));
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
}
