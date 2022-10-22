<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class Categorie extends Model
{
    use HasFactory;

    protected $table="categories";
    protected $fillable=["libelle"];

    public function produits(){
        return $this->hasMany(Produit::class);
    }
}
