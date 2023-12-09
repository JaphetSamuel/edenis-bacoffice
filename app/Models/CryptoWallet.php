<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class CryptoWallet extends Model
{
    use HasFactory;
    use HasStatuses;

    protected $table = 'cripto_wallets';

    protected $fillable = [
        'name',
        'adresse',
        'portefeuille_id'
    ];

    public function portefeuille()
    {
        return $this->belongsTo(Portefeuille::class);
    }

    public static function boot()
    {
        static::addGlobalScope('current', function (Builder $builder) {
            $builder->where('portefeuille_id', Portefeuille::current()->id);
        });

        parent::boot();
    }
}
