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

    public function save(array $options = [])
    {
        $this->user_id = auth()->user()->id;
        return parent::save($options);
    }

    use HasFactory;
}
