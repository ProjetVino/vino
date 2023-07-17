<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellier extends Model
{
    use HasFactory;

    protected $fillable = [

        'id',
        'nom',
        'note',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bouteilles()
    {
        return $this->belongsToMany(Bouteille::class, 'bouteilles_celliers', 'cellier_id', 'bouteille_id')
            ->withPivot('quantite','note','id');
    }
}
