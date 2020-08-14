<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Product extends Model
{

    protected $fillable = ['category_id','nombre', 'slug','cantidad',
    'porcentaje_descuento','precio_actual','descripcion_larga', 
    'descripcion_corta','datos_interes','especificaciones','estado',
    'activo','slideprincipal' 
    ];

    public Function category(){
        return $this->belongsTo('App\Category');
        //return $this->belongsTo(Category::class);
       //return $this->belongsTo(Category::class,'category_id');
    }

    //un producto va contener muchas imagenes
    public function images(){
        return $this->morphMany('App\Image','imageable');
    }
}
