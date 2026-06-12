<?php

namespace App\Models;

use App\Enums\ReceiptStatus;
use Database\Factories\RecuFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recu extends Model
{
    /** @use HasFactory<RecuFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'text_brut',
        'status',
        'json',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'status' => ReceiptStatus::class,
            'json' => 'array',
        ];
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Depenses(){
        return $this->hasMany(Depense::class);
    }
}
