<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BouteilleCellier extends Model
{
    use HasFactory;

    protected $table='bouteilles_celliers';

    protected $fillable = [
        'id',
        'cellier_id',
        'bouteille_id',
        'quantite',
        'note',
    ];

    public function cellier()
    {
        return $this->belongsTo(Cellier::class);
    }

    public function bouteilles()
    {
        return $this->belongsTo(Bouteille::class);
    }

}
