<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kyc extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'ville',
        'pays',
        'lieu_naissance',
        'date_naissance',
        'nationalite',
        'profession',
        'type_piece',
        'piece_identite',
        'numero_piece_identite',
        'photo',
        'signature',
        'numero_telephone',
        'user_id',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'piece_identite' => 'array',
        'photo' => 'array',
        'signature' => 'array',
    ];

    public function save(array $options = [])
    {
        $this->user_id = auth()->user()->id;
        // convert to base64
        $this->signature = 'null';
        return parent::save($options);
    }

    use HasFactory;
}
