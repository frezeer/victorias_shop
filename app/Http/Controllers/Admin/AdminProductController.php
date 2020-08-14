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
        $productos = Product::where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(2);
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
        $categorias = Category::all();
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
            'nombre'      => 'required|max:50|unique:categories,nombre',
            'slug'        =>  'required|max:2|unique:categories,slug',  
            'descripcion' => 'required|max:2' ]);

        Product::create($request->all());
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
