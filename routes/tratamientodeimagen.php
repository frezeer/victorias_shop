<?php

use App\Category;
use App\Product;
use App\Image;

//para hacer la prueba con Imagenes
Route::get('/prueba', function () {
    return "pruebas";
});

//mostrar resultados
Route::get('/resultados', function () {
    $image = App\Image::orderBy('id','desc')->get();
    return $image;
});

Route::get('/', function () {
    return view('tienda.index');
});

Route::get('/usuarios', function () {
   
   //$usuario = App\User::orderBy('id','desc')->get();
   
   $imagen = new App\Image(['url' => 'imagenes/113.jpg']);

   $usuario = App\User::find(1);

   $usuario->image()->save($imagen);

   return $usuario;

   });