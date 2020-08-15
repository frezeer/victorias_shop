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





//cuenta las imagenes que tiene este usuario y lo agrega com campo
////http://localhost:8000/conteoimagesusuario
Route::get('/conteoimagesusuario2', function () {
    $usuario = App\User::find(1);
      return $usuario->loadCount('image');
});

//cuenta las imagenes que tiene este usuario y lo agrega com campo
////http://localhost:8000/conteoimagesusuario
Route::get('/conteoimagesproductos2', function () {
    $producto = App\Product::find(4);
      return $producto->loadCount('images');
});
//cuenta las imagenes que tiene este usuario y lo agrega com campo
////http://localhost:8000/conteoimagesusuario
Route::get('/conteoimagesusuario', function () {
    $usuario = App\User::withCount('image')->get();
    $usuario = $usuario->find(1);
    return $usuario; //obtengo el objeto completo
    //return $usuario->image_count; //accedo a ese campo en especifico
});


//cuenta las imagenes que tiene este usuario y lo agrega com campo
////http://localhost:8000/conteoimagesusuario
Route::get('/conteoimagesproducto', function () {
    $producto = App\Product::withCount('images')->get();
    $producto = $producto->find(4);
    return $producto;
});


//actualizar una imagen 
//http://localhost:8000/updateimages
Route::get('/updateimages', function () {
   
   $usuario = App\User::find(1);
   $usuario->image->url='imagenes/255.jpg';
   $usuario->push();
   return $usuario->image;
}); 


//con esto me trae el producto o el usuario 
//que pertence la imagen 
//http://localhost:8000/consultaimageable
Route::get('/consultarproducto', function () {
   
   $producto = App\Product::find(5);
   return $producto->images()->where('url','imagenes/a.png')->get();
   //si hay varias imagenes llamdas de la misma manera
   return $producto->images()->where('url','imagenes/a.png')->orderBy('id','DESC')->get();
}); 

//con esto me trae el producto o el usuario 
//que pertence la imagen 
//http://localhost:8000/consultaimageable
Route::get('/consultaimageable', function () {
   
   $image = App\Image::find(4);
   return $image->imageable;
}); 


//actualizar una imagen 
//http://localhost:8000/updateimages
Route::get('/updateimagesproducts', function () {
   
   $producto = App\Product::find(5);
   $producto->images[0]->url='imagenes/a.png';
   $producto->push();
   return $producto->images;
}); 

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
Route::get('/saveimageness', function () {
    
   //al producto con id 1 salva todas las imagenes
   $producto = App\Product::find(5);

   $producto->images()->saveMany([ 

       new App\Image(['url' => 'imagenes/108.jpg']),
       new App\Image(['url' => 'imagenes/158.jpg']),
       new App\Image(['url' => 'imagenes/113.jpg']),
   
       ]);  
      //retorna las imagenes del producto
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


