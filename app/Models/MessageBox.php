<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'libelle',
        'contenu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
