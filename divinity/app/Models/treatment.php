<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Treatment extends Model {
    use HasFactory;

    protected $casts = [
        'prices' => MoneyCast::class,
    ];

    public function patient(): BelongsTo  {
        return $this->belongsTo( related: Patient::class );
    }
}