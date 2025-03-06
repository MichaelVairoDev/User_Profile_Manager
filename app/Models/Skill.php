<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('level')
                    ->withTimestamps();
    }

    public static function getCategories(): array
    {
        return [
            'programming' => 'Programación',
            'languages' => 'Idiomas',
            'soft_skills' => 'Habilidades Blandas',
            'frameworks' => 'Frameworks',
            'databases' => 'Bases de Datos',
            'tools' => 'Herramientas',
        ];
    }
}
