<?php

use App\Category;
use App\Product;
use App\Image;

//mostrar resultados
//dame todos los resultados de imagenes y ordena por id de forma descendente
Route::get('/resultados', function () {
    $image = App\Image::orderBy('id','desc')->get();
    return $image;
});
//muestrame todos los usuarios
Route::get('/getusuarios', function () {
    $image = App\Image::orderBy('id','asc')->get();
    return $image;
});


//salvar una imagen 
//http://localhost:8000/push
Route::get('/push', function () {
   
   $usuario = App\User::find(1);
   $usuario->image->url='imagenes/113.jpg';
   $usuario->push();
   return $usuario->image;
}); 

//salvar una imagen 
//http://localhost:8000/saveusuario
Route::get('/saveusuario', function () {
   //la imagen con URL salva al usuario con id 1
   $imagen = new App\Image(['url' => 'imagenes/113.jpg']);
   $usuario = App\User::find(1);
   $usuario->image()->save($imagen);
   return $usuario;
}); 

//salvar una imagen con metedo create
//http://localhost:8000/createusuario
Route::get('/createusuario', function () {
   //la imagen con URL salva al usuario con id 1
   $usuario = App\User::find(1);
   $usuario->image()->create([
      'url' => 'imagenes/113.jpg',
   ]);
   return $usuario;
}); 



//salvar una imagen con metedo create
//http://localhost:8000/createusuarios
Route::get('/createusuarios', function () {
   //la imagen con URL salva al usuario con id 1
   $imagen = [];
   $imagen['url'] = 'imagenes/113.jpg';
   $usuario = App\User::find(1);
   $usuario->image()->create( $imagen );
   return $usuario;
}); 


//salvar una imagen con metedo create
//http://localhost:8000/createmanyusuarios
Route::get('/createmanyusuarios', function () {
   //la imagen con URL salva al usuario con id 1
   $imagen = [];

   $imagen[]['url'] = 'imagenes/113.jpg';
   $imagen[]['url'] = 'imagenes/108.jpg';
   $imagen[]['url'] = 'imagenes/181.jpg';
   $imagen[]['url'] = 'imagenes/223.jpg';
   $imagen[]['url'] = 'imagenes/255.jpg';

   $producto = App\Product::find(4);

   $producto->images()->createMany($imagen);

   return $producto->images;
}); 



//salvar varias imagenes para productos
//http://localhost:8000/saveimagenes
Route::get('/saveimagenes', function () {
    
   //al producto con id 1 salva todas las imagenes
   $producto = App\Product::find(5);

   $producto->images()->saveMany([ 

       new App\Image(['url' => 'imagenes/108.jpg']),
       new App\Image(['url' => 'imagenes/158.jpg']),
       new App\Image(['url' => 'imagenes/113.jpg']),
   
       ]);  

     return $producto;
}); 


//salvar varias imagenes para productos
//http://localhost:8000/saveimagenes
Route::get('/saveimagene', function () {
    
   //al producto con id 1 salva todas las imagenes
   $producto = App\Product::find(5);

   $producto->images()->saveMany([ 

       new App\Image(['url' => 'imagenes/108.jpg']),
       new App\Image(['url' => 'imagenes/158.jpg']),
       new App\Image(['url' => 'imagenes/113.jpg']),
   
       ]);  

     return $producto->images;
}); 

Route::get('/resultados', function () {
    $image = App\Image::orderBy('id','desc')->get();
    return $image;
});

//http://localhost:8000/getusuarios
//para hacer la prueba con Imagenes
Route::get('/getusuario', function () {
   
   //$usuario = App\User::orderBy('id','desc')->get();
   // bsuca al usuario con id 1 y dime si tiene imagenes 
   $usuario = App\User::find(1);
   $image = $usuario->image;
   if($image){
      echo "Tiene imagen";
   }else{
      echo "No tiene imagen";
   }
   return $image;
   });

//muestrame todos los usuarios
Route::get('/returnusuario', function () {
    //$image = App\Image::orderBy('id','desc')->get();
    $usuario = App\User::find(1);
    return $usuario->image;
});

Route::get('/returnimageurl', function () {
 $usuario = App\User::find(1);
   $image = $usuario->image->url;
   return $image;
});
