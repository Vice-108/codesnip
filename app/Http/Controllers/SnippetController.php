<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SnippetController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $snippets = Snippet::with('user')
            ->where('is_public', true)
            ->latest()
            ->paginate(12);
        if (auth()->check()) {
            $snippets->through(function ($snippet) {
                $snippet->is_favorite = $snippet->favoritedBy()->where('user_id', auth()->id())->exists();
                return $snippet;
            });
        }
        return Inertia::render('snippets/Snippets', [
            'snippets' => $snippets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('snippets/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string',
            'language' => 'nullable|string|max:50',
            'is_public' => 'boolean',
        ]);

        $snippet = $request->user()->snippets()->create($validated);

        return redirect()->route('snippets.show', $snippet);
    }

    /**
     * Display the specified resource.
     */
    public function show(Snippet $snippet)
    {
        if (!$snippet->is_public && $snippet->user_id !== auth()->id()) {
            abort(403);
        }

        $snippet->load('user');
        $snippet->increment('views_count');
        // Add is_favorite check for authenticated users
        if (auth()->check()) {
            $snippet->is_favorite = $snippet->favoritedBy()->where('user_id', auth()->id())->exists();
        } else {
            $snippet->is_favorite = false;
        }

        return Inertia::render('snippets/Show', [
            'snippet' => $snippet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Snippet $snippet)
    {
        $this->authorize('update', $snippet);

        return Inertia::render('snippets/Edit', [
            'snippet' => $snippet
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Snippet $snippet)
    {
        $this->authorize('update', $snippet);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string',
            'language' => 'nullable|string|max:50',
            'is_public' => 'boolean',
        ]);

        $snippet->update($validated);

        return redirect()->route('snippets.show', $snippet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Snippet $snippet)
    {
        $this->authorize('delete', $snippet);

        $snippet->delete();
        
    }

    public function toggleFavorite(Snippet $snippet)
    {
        $user = auth()->user();
        $user->favoriteSnippets()->toggle($snippet->id);

        $snippet->favorites_count = $snippet->favoritedBy()->count();
        $snippet->save();

        return back();
    }

    public function mySnippets()
    {
        $snippets = auth()->user()->snippets()
        ->orderBy('id')
        ->paginate(15);

        $snippets->transform(function ($snippet) {
            $snippet->is_favorite = $snippet->favoritedBy()->where('user_id', auth()->id())->exists();
            return $snippet;
        });

        return Inertia::render('snippets/MySnippets', [
            'snippets' => $snippets
        ]);
    }
}
