<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class AdminProductController extends Controller
{
    /*
        Middleware para proteger el acceso 
        a usuarios no autentcados
    */
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $nombre = $request->get('nombre');
     $total = Product::count();
     $productos = Product::with('images','category')->where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(5);
     return view('admin.product.index',compact('productos','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $total = Product::count();
        //$productos = Product::all(); 
        $categorias = Category::orderBy('nombre')->get();
        return view('admin.product.create',compact('categorias','total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([

            'nombre'        =>       'required|max:50|unique:products,nombre',
            'slug'          =>       'required|max:50|unique:products,slug',
            'category_id'   =>       'required',
            'imagenes.*'    =>       'image|mimes:jpeg,gif,png,jpg,svg|max:2048',
            'precio_actual' =>       'required',
            'cantidad'      =>       'required',
            'estado'        =>       'required',
            'descripcion_corta' =>   'required|max:20',
            'descripcion_larga' =>   'required|max:100'

             ]);

             $urlimagenes = [];

            if($request->hasFile('imagenes'))
            {
                $imagenes = $request->file('imagenes');
                //dd($imagenes);
                foreach ($imagenes as $imagen){

                    $nombre = time().'_'.$imagen->getClientOriginalName();

                    $ruta = public_path().'/imagenes';
                    
                    $imagen->move($ruta, $nombre);
                    
                    $urlimagenes[]['url'] = '/imagenes/'.$nombre;

                }
               //return $urlimagenes;
            }

            $prod = new Product();            
            $prod->nombre               = $request->nombre;
            $prod->slug                 = $request->slug;
            $prod->category_id          = $request->category_id;
            $prod->cantidad             = $request->cantidad;
            $prod->precio_actual        = $request->precio_actual;
            $prod->porcentaje_descuento = $request->porcentaje_descuento;
            $prod->descripcion_corta    = $request->descripcion_corta;
            $prod->descripcion_larga    = $request->descripcion_larga;   
            $prod->datos_interes        = $request->datos_interes;
            $prod->especificaciones     = $request->especificaciones;
            $prod->estado               = $request->estado;    
            
            

            if($request->activo)
            {
                $prod->activo = "Si";
                }else{
                 $prod->activo = "No";
            }  
            
                if($request->slideprincipal)
                {
                $prod->slideprincipal = "Si";
                }
                else
                {
                 $prod->slideprincipal = "No";
                } 
            
            
            $prod->save();

            $prod->images()->createMany($urlimagenes);

            //return $prod->images;
        //return Product::create($request->all());
         return redirect()->route('admin.product.index')->with('datos','Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
          $productos = Product::where('slug',$slug)->firstOrFail();
          $editar = 'Si';
          $total = Product::count();
          return view('admin.product.show',compact('productos','editar','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
          $productos = Product::where('slug',$slug)->firstOrFail();
          $total = Product::count();
          $editar = 'Si';
          return view('admin.product.edit',compact('productos','editar','total'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productos = Product::findOrFail($id);
        $request->validate([
            'nombre'      => 'required|max:50|unique:categories,nombre,'.$productos->id,
            'slug'        => 'required|max:50|unique:categories,slug,'.$productos->id,  
            'descripcion' => 'required|max:50,'.$productos->id 
        ]);

        $productos->fill($request->all())->save();
        //return $cat;
        return redirect()->route('admin.product.index')->with('datos','Producto editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productos = Product::findOrFail($id);
        $productos->delete();
        return redirect()->route('admin.product.index')->with('datos','Producto eliminado correctamente');
    }
}
