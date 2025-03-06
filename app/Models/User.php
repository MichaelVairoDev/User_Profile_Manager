<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'location',
        'birth_date',
        'phone',
        'profession',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
        ];
    }

    public function workExperiences(): HasMany
    {
        return $this->hasMany(WorkExperience::class)->orderBy('current_job', 'desc')->orderBy('end_date', 'desc');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)
                    ->withPivot('level')
                    ->withTimestamps();
    }

    public function getAge(): ?int
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    public function getCurrentJob(): ?WorkExperience
    {
        return $this->workExperiences()->where('current_job', true)->first();
    }

    public function getYearsOfExperience(): int
    {
        $experiences = $this->workExperiences;
        $totalYears = 0;

        foreach ($experiences as $experience) {
            $start = $experience->start_date;
            $end = $experience->current_job ? now() : ($experience->end_date ?? now());
            $totalYears += $start->diffInYears($end);
        }

        return $totalYears;
    }

    public function getTopSkills(int $limit = 5): array
    {
        return $this->skills()
                    ->orderBy('skill_user.level', 'desc')
                    ->take($limit)
                    ->get()
                    ->map(function ($skill) {
                        return [
                            'name' => $skill->name,
                            'level' => $skill->pivot->level,
                            'category' => $skill->category,
                        ];
                    })
                    ->toArray();
    }

    public function getSkillsByCategory(): array
    {
        return $this->skills()
                    ->get()
                    ->groupBy('category')
                    ->toArray();
    }
}
