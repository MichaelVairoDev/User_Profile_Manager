<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $skillsByCategory = auth()->user()->getSkillsByCategory();
        $categories = Skill::getCategories();

        return view('skills.index', compact('skillsByCategory', 'categories'));
    }

    public function create(): View
    {
        $categories = Skill::getCategories();
        $existingSkills = Skill::orderBy('name')->get();
        return view('skills.create', compact('categories', 'existingSkills'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'skill_id' => 'nullable|exists:skills,id',
            'name' => 'required_without:skill_id|string|max:255',
            'category' => 'required_without:skill_id|string|max:255',
            'level' => 'required|integer|min:1|max:5',
        ]);

        if (isset($validated['skill_id'])) {
            $skill = Skill::find($validated['skill_id']);
        } else {
            $skill = Skill::firstOrCreate([
                'name' => $validated['name'],
                'category' => $validated['category'],
            ]);
        }

        auth()->user()->skills()->attach($skill->id, ['level' => $validated['level']]);

        return redirect()->route('skills.index')
            ->with('status', 'skill-added');
    }

    public function edit(Skill $skill): View
    {
        $userSkill = auth()->user()->skills()->findOrFail($skill->id);
        return view('skills.edit', [
            'skill' => $userSkill,
            'level' => $userSkill->pivot->level,
        ]);
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'level' => 'required|integer|min:1|max:5',
        ]);

        auth()->user()->skills()->updateExistingPivot($skill->id, [
            'level' => $validated['level'],
        ]);

        return redirect()->route('skills.index')
            ->with('status', 'skill-updated');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        auth()->user()->skills()->detach($skill->id);

        return redirect()->route('skills.index')
            ->with('status', 'skill-removed');
    }

    public function search(Request $request)
    {
        $term = $request->get('term');
        $skills = Skill::where('name', 'LIKE', "%{$term}%")
            ->orderBy('name')
            ->take(10)
            ->get()
            ->map(function($skill) {
                return [
                    'id' => $skill->id,
                    'text' => $skill->name . ' (' . $skill->category . ')'
                ];
            });

        return response()->json($skills);
    }
}
