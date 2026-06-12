<?php

namespace App\Models;

use App\Enums\ExpenseCategory;
use Database\Factories\DepenseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    /** @use HasFactory<DepenseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'categorie',
        'recu_id'
    ];

    protected function casts(): array
    {
        return [
            'categorie' => ExpenseCategory::class,
        ];
    }

    public function Recu(){
        return $this->belongsTo(Recu::class);
    }
}
