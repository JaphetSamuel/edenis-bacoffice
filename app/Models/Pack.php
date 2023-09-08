<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'code',
        'prix',
        'quantite',
        'description',
    ];

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
