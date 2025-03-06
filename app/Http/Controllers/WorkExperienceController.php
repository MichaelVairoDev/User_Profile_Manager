<?php

namespace App\Http\Controllers;

use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WorkExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = auth()->user()->workExperiences;
        return view('work-experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('work-experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'current_job' => 'boolean',
            'location' => 'nullable|string|max:255',
            'company_website' => 'nullable|url|max:255',
        ]);

        $experience = auth()->user()->workExperiences()->create($validated);

        return redirect()->route('work-experiences.index')
            ->with('status', 'experience-created');
    }

    public function edit(WorkExperience $workExperience): View
    {
        $this->authorize('update', $workExperience);
        return view('work-experiences.edit', ['experience' => $workExperience]);
    }

    public function update(Request $request, WorkExperience $workExperience): RedirectResponse
    {
        $this->authorize('update', $workExperience);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'current_job' => 'boolean',
            'location' => 'nullable|string|max:255',
            'company_website' => 'nullable|url|max:255',
        ]);

        $workExperience->update($validated);

        return redirect()->route('work-experiences.index')
            ->with('status', 'experience-updated');
    }

    public function destroy(WorkExperience $workExperience): RedirectResponse
    {
        $this->authorize('delete', $workExperience);

        $workExperience->delete();

        return redirect()->route('work-experiences.index')
            ->with('status', 'experience-deleted');
    }
}
