<?php

namespace App\Models;

use App\Enums\TokenType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Token extends Model
{
    use HasFactory;

    protected  $fillable = [
        'tokenable_id',
        'tokenable_type',
        'type',
        'token',
        'expires_at',
        'created_at',
        'updated_at'
    ];

    protected $cast = [
        'expires_at' => 'datetime'
    ];

    public function tokenable() : MorphTo
    {
        return $this->morphTo();
    }

    public function isExpired() : bool
    {
        return Carbon::createFromIsoFormat('YYYY-MM-DD HH:mm:ss', $this->expires_at)->isPast();
    }


}
