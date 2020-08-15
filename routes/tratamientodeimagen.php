
<?php 

use App\Category;
use App\Product;
use App\Image;


//$producto = App\Product::find(1);
//$imagen = $producto->images;
//$categoria = $producto->category;



//eliminar una imagen que pertenece a un producto
////http://localhost:8000/productos-eliminar-imagen
Route::get('/productos-eliminar-imagen/todos', function () {

        $productos = App\Product::find(4);
           $productos->images()->delete();
            return $productos;
});


//eliminar una imagen que pertenece a un producto
////http://localhost:8000/productos-eliminar-imagen
Route::get('/productos-eliminar-imagen', function () {

    $productos = App\Product::find(4);
       $productos->images[0]->delete();
       return $productos;
});


//me trae todos los productos y sus imagenes en arreglo
////http://localhost:8000/productos-imagenes-categorias
Route::get('/productos-imagenes-categorias', function () {

    $productos = App\Product::with('images','category')->get();
      return $productos;
});

//me trae todos los productos y sus imagenes en arreglo
////http://localhost:8000/productos-imagenes-categorias-4
Route::get('/productos-imagenes-categorias-4', function () {

    $productos = App\Product::with('images','category')->find(4);
      return $productos;
});


//me trae todos los productos  sus imagenes y su categoria en arreglo delimiatdo por 
// los campos que me interesan
////http://localhost:8000/productos-imagenes-categorias-5

Route::get('/productos-imagenes-categorias-6', function () {
    $productos = App\Product::with('images:id,imageable_id,url','category:id,nombre')->find(4);
            return ($productos);
});

//me trae todos los productos  sus imagenes y su categoria en arreglo
////http://localhost:8000/productos-imagenes-categorias-5

Route::get('/productos-imagenes-categorias-5', function () {

    $productos = App\Product::with('images','category')->find(4);
    $categoria_nombre = $productos->category->nombre;
    $imagen_nombre    = $productos->images[2]->url;
    return ($categoria_nombre.','.$imagen_nombre);
});

//me trae todos los productos y sus imagenes en arreglo
////http://localhost:8000/productos-imagenes 
Route::get('/productos-imagenes', function () {

    $productos = App\Product::with('images')->get();
      return $productos;
});

//me trae el producto con id 4 y sus imagenes
////http://localhost:8000/productos
Route::get('/productos4', function () {

    $productos = App\Product::with('images')->find(4);
      return $productos;
});

//me trae el producto con id 4 y sus imagenes accediendo al objeto
////http://localhost:8000/productos
Route::get('/productos-images', function () {

    $productos = App\Product::with('images')->find(4);
      return $productos->images[2]->url;
});



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



 <!div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Sección de Precios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Precio anterior</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input class="form-control" 
                  type="number" id="precioanterior" name="precio_anterior" min="0" value="0" step=".01"
                  value={{ old('precio_anterior') }} >

                </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-3">
              <div class="form-group">

                <label>Precio actual</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input class="form-control" type="number" id="precio_actual" name="precio_actual" min="0" value="0" step=".01" >
                </div>

                <br>
                <span id="descuento"></span>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->




            <div class="col-md-6">
              <div class="form-group">
                <label>Porcentaje de descuento</label>
                <div class="input-group">
                  <input class="form-control" type="number" id="porcentaje_descuento" name="porcentaje_descuento" step="any" min="0" min="100" value="0" >
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>
                </div>

                <br>
                <div class="progress">
                  <div id="barraprogreso" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
      </div--->
      <!-- /.card -->

      
    {{ $productos[1] }}<br />
  
    {{ $productos[1]->category }}<br />
    
    {{ $productos[1]->images }}