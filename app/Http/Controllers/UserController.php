<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        $users = User::withCount(['workExperiences', 'skills'])
                    ->orderBy('name')
                    ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $this->authorize('view', $user);

        $user->load(['workExperiences', 'skills']);
        $topSkills = $user->getTopSkills();
        $currentJob = $user->getCurrentJob();
        $yearsOfExperience = $user->getYearsOfExperience();

        return view('users.show', compact('user', 'topSkills', 'currentJob', 'yearsOfExperience'));
    }

    public function create(): View
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'bio' => ['nullable', 'string', 'max:1000'],
            'location' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'phone' => ['nullable', 'string', 'max:20'],
            'profession' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('status', 'user-created');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta desde aquí.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('status', 'user-deleted');
    }
}
