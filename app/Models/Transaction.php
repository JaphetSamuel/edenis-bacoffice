<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Transaction extends Model
{
    use HasFactory;
    use HasStatuses;

    protected $fillable = [
        'portefeuille_id',
        'type',
        'montant',
        'status',
        'numero_transaction',
        'description',
        'sens',
        'hash'
    ];

    public function portefeuille()
    {
        return $this->belongsTo(Portefeuille::class);
    }

    public function getTypeAttribute($value)
    {
        return TransactionType::from($value);
    }

    public function setTypeAttribute($value)
    {
        if($value instanceof TransactionType) {
            $this->attributes['type'] = $value->value;
        }
        else
        {
            $this->attributes['type'] = TransactionType::from($value)->value;
        }

    }

    public function getStatusAttribute($value)
    {
        return TransactionStatus::from($value);
    }

    public function setStatusAttribute($value)
    {
        if($value instanceof TransactionStatus) {
            $this->attributes['status'] = $value->value;
        }
        else
        {
            $this->attributes['status'] = TransactionStatus::from($value)->value;
        }
    }

    public function generateNumeroTransaction()
    {
        $this->numero_transaction = 'TRX' . time();
    }

    public function generateHash()
    {
        $this->hash = uniqid("trx_");
    }




}
