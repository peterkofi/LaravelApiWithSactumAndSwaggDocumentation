<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marchand extends Model
{
    use HasFactory;
    protected $table ="marchands";
    protected $fillable=[
        "nom",
        "prenom",
        "contact",
        "Adresse"
    ];
}
