<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;

class Produit extends Model
{
    use HasFactory;

    protected $table ="produits";
    protected $fillable =[
        "libelle",
        "description",
        "prix",
        "idCategorie"
    ];

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    
}
