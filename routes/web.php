<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Category;
use App\Product;
use App\Image;



//http://localhost:8000/saveusuario
Route::get('/saveusuario', function () {

   $imagen = new App\Image(['url' => 'imagenes/113.jpg']);

   $usuario = App\User::find(1);

   $usuario->image()->save($imagen);

   return $usuario;
}); 

//http://localhost:8000/getusuarios
//para hacer la prueba con Imagenes
Route::get('/getusuario', function () {
   
   //$usuario = App\User::orderBy('id','desc')->get();
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
Route::get('/getusuarios', function () {
    $image = App\Image::orderBy('id','desc')->get();
    return $image;
});


//muestrame todos los usuarios
Route::get('/returnusuario', function () {
    //$image = App\Image::orderBy('id','desc')->get();
    $usuario = App\User::find(1);
    return $usuario->image;
});


Route::get('/', function () {

// $cat = new Category();
// $cat->nombre = "Mujeres";
// $cat->slug='Mujeres';
// $cat->descripcion="Ropa para mujeres";
// $cat->save();
// return $cat;

// $cat = new Category();
// $cat->nombre = "Hombres";
// $cat->slug='hombres';
// $cat->descripcion="Ropa para hombres";
// $cat->save();
// return $cat;

 //$prod = new Product();
 //$prod->findOrFail(1);
 //$prod->nombre ="Producto 1";
 //$prod->slug   = "producto-1";
 //$prod->category_id = 1;
// $prod->descripcion_corta = "Producto";
// $prod->descripcion_larga = "Producto";
// $prod->especificaciones = "Producto";
// $prod->datos_interes = "Producto";
// $prod->estado = "Nuevo";
// $prod->activo = "Si";
// $prod->slideprincipal ="No";
 //$prod->save();
// return $prod;

// $prod = new Product();
// $prod->nombre = "Producto 2";
// $prod->slug   = "Producto 2";
// $prod->category_id = 2;
// $prod->descripcion_corta = "Producto";
// $prod->descripcion_larga = "Producto";
// $prod->especificaciones = "Producto";
// $prod->datos_interes = "Producto";
// $prod->estado = "Nuevo";
// $prod->activo = "Si";
// $prod->slideprincipal ="No";
// $prod->save();
// return $prod;
    
     //busca el producto por id  y muestra el primero
     
     
    // //  //Busca en las categorias con id 2 todos los productos dentro de estas categoria
    //  $cat = Category::find(2)->products;
    // //  //Busca en las categorias con id 1 todos los productos dentro de estas categorias
    // //  $cat = Category::find(1)->products->count();
    //   return $cat;    

    //   /*
    //   nos dice en los productos que categoria esta 
    //   si el id no existe marca un error  
    //   */

    //  //$prod = Product::find(8)->first()->category;
    //   //$prod = Product::find(8)->category;
    //      return $prod;

    return view('tienda.index');
});


Route::get('/administracion', function () {
   $total = Category::count(); return view('plantillas.admin',compact('total'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () { $total = Category::count(); return view('plantillas.admin',compact('total')); })->name('admin');

Route::resource('admin/category','Admin\AdminCategoryController')->names('admin.category');

Route::resource('admin/product' ,'Admin\AdminProductController')->names('admin.product');

Route::get('cancelar/{ruta}', function ($ruta) {return redirect()->route($ruta)->with('cancelar','Acción Cancelada!'); })->name('cancelar');


