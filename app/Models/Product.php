<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    // SOMENTE ESSES SERÃO VALIDADOS NO FORM
    protected $fillable = ['name', 'description', 'price', 'category_id', 'image'];

    // CATEGORIA DO PRODUTO
    // Só usa o belongsTo quando tem 1 do lado de la
    // belongsTo = PERTENCE Á ESSE PRODUTO
    // FAZ UM INNER JOIN DA CATEGORIES USANDO ID_CATEGORY
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        // REPRESENTA UM INNER JOIN DE 2 TABELAS
        return $this->belongsToMany(Tag::class);
    }

    // REGRA PARA RETORNAR AS PROMOÇOES
    public static function promocoes(){
        return Product::all()->take(3);
    }
}
