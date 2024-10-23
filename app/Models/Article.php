<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        "designation",
        "reference",
        "qtestock",
        "imageart",
        "prix",
        "marque",
        "scategorieID"

    ];
    public function scategorie()
    {
        return $this->belongsTo(Scategorie::class,"scategorieID");
    }

}
