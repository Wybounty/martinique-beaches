<?php

namespace App\Http\Controllers;

use App\Models\Beach;
use App\Models\Commune;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BeachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beaches = Beach::query()
            ->with('commune')
            ->orderBy('nom')
            ->paginate(3);

        return view('index', compact('beaches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $communes = Commune::query()
            ->orderBy('nom')
            ->get();

        return view('create', compact('communes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'commune_id' => ['required', 'integer', Rule::exists((new Commune)->getTable(), 'id')],
            'description' => ['nullable', 'string'],
        ]);

        Beach::create([
            'nom' => $validated['nom'],
            'commune_id' => $validated['commune_id'],
            'description' => filled($validated['description'] ?? null)
                ? $validated['description']
                : null,
        ]);

        return redirect()
            ->to('/')
            ->with('success', 'La plage a bien ete ajoutee.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beach $beach)
    {
        $communes = Commune::query()
            ->orderBy('nom')
            ->get();

        return view('edit', compact('beach', 'communes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beach $beach): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'commune_id' => ['required', 'integer', Rule::exists('communes', 'id')],
            'description' => ['nullable', 'string'],
        ]);

        $beach->update([
            'nom' => $validated['nom'],
            'commune_id' => $validated['commune_id'],
            'description' => filled($validated['description'] ?? null)
                ? $validated['description']
                : null,
        ]);

        return redirect()
            ->to('/')
            ->with('success', 'La plage a bien ete mise a jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beach $beach): RedirectResponse
    {
        $beach->delete();

        return redirect()
            ->to('/')
            ->with('success', 'La plage a bien ete supprimee.');
    }
}
