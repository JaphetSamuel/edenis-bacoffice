<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchatPack extends Model
{
    use HasFactory;

    protected $fillable = [
        'pack_id',
        'user_id',
        'quantite',
        'status'
    ];

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
