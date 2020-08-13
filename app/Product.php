<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Product extends Model
{
    public Function category(){
        return $this->belongsTo('App\Category');
        //return $this->belongsTo(Category::class);
       //return $this->belongsTo(Category::class,'category_id');
    }
}
