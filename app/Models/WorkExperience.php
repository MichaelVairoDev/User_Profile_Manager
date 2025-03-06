<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'position',
        'description',
        'start_date',
        'end_date',
        'current_job',
        'location',
        'company_website',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'current_job' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDurationAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        if ($this->current_job) {
            return "$start - Presente";
        }
        return $this->end_date ? "$start - " . $this->end_date->format('M Y') : $start;
    }
}
