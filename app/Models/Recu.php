<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recu extends Model
{
    protected $fillable = [
        'title',
        'text_brut',
        'status',
        'json',
        'user_id'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Depenses(){
        return $this->hasMany(Depense::class);
    }
}
