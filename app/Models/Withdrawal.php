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
        'status',
        'payment_date',
        'is_paid',
        'is_deleted',
    ];

    public function portefeuille()
    {
        return $this->belongsTo(Portefeuille::class);
    }


}
