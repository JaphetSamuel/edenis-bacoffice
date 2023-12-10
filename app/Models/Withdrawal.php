<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Withdrawal extends Model
{
    use HasFactory;
    use HasStatuses;

    protected  $fillable = [
        'portefeuille_id',
        'amount',
        'payment_date',
        'is_paid',
        'is_deleted',
        'code'
    ];

    public function portefeuille()
    {
        return $this->belongsTo(Portefeuille::class);
    }

    public function token()
    {
        return $this->morphOne(Token::class, 'tokenable');
    }


}
