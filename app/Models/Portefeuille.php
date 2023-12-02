<?php

namespace App\Models;

use App\Enums\TransactionSens;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portefeuille extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'solde',
        'solde_depot',
        'titres',
        'solde_reel',
        'titres'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function balance()
    {
        $debit = $this->transactions()
            ->where('sens', TransactionSens::DEBIT)
            ->where('status',  TransactionStatus::ACCEPTEE)
            ->sum('montant');

        $credit = $this->transactions()
            ->where('sens', TransactionSens::CREDIT)
            ->where('status',  TransactionStatus::ACCEPTEE)
            ->sum('montant');

        return $credit - $debit;
    }

    public function registerTransaction(Transaction $transaction)
    {
        $transaction->portefeuille()->associate($this);
        $transaction->save();

        $this->solde = $this->solde + $transaction->montant;
        $this->save();
    }

    public static  function current():Portefeuille
    {
        $portefeuille = auth()->user()->portefeuille;

        if (!$portefeuille and true) {
            $portefeuille = Portefeuille::create([
                'user_id' => auth()->user()->id,
                'solde' => 0,
                'solde_depot' => 0,
                'solde_reel' => 0,
                'titres' => 0
            ]);
        }

        return $portefeuille;
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }


}
