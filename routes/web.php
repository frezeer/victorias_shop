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
//use App\Category;
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
    return view('plantillas.admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', function () {return view('plantillas.admin'); })->name('admin');
Route::resource('admin/category','Admin\AdminCategoryController')->names('admin.category');

Route::get('cancelar/{ruta}', function ($ruta) {return redirect()->route($ruta)->with('cancelar','Acción Cancelada!'); })->name('cancelar');


