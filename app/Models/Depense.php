<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'categorie',
        'recu_id'
    ];

    public function Recu(){
        return $this->belongsTo(Recu::class);
    }
}
