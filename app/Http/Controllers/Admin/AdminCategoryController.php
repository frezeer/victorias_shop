<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class AdminCategoryController extends Controller
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
        $total = Category::count();
        $categorias = Category::where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(5);
        
            return view('admin.category.index',compact('categorias','total'));

         //$categorias = Category::orderBy('nombre','asc')->paginate(5);   
         //$categorias = Category::all();
         //$product= Product::orderBy('created_at','desc')->get();
         // $categorias = Category::orderBy('nombre','DESC');
         //return view('admin.category.edit',compact('cat','editar'));
         //return view('admin.category.index')->with(compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create(Request $request)
    {
        $total = Category::count(); 
        return view('admin.category.create',compact('total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //return Category::create($request->all());

           $request->validate([
            'nombre'      => 'required|max:50|unique:categories,nombre',
            'slug'        => 'required|max:50|unique:categories,slug',  
            'descripcion' => 'required|max:50' ]);

        Category::create($request->all());
        return redirect()->route('admin.category.index')->with('datos','Registro crado correctamente');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
          $cat = Category::where('slug',$slug)->firstOrFail();
          $editar = 'Si';
          $total = Category::count();
          return view('admin.category.show',compact('cat','editar','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
          $cat = Category::where('slug',$slug)->firstOrFail();
          $total = Category::count();
          $editar = 'Si';
          return view('admin.category.edit',compact('cat','editar','total'));
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
        $cat = Category::findOrFail($id);
        
        $request->validate([
            'nombre'      => 'required|max:50|unique:categories,nombre,'.$cat->id,
            'slug'        => 'required|max:50|unique:categories,slug,'.$cat->id,  
            'descripcion' => 'required|max:50,'.$cat->id 
        ]);

        $cat->fill($request->all())->save();
        //return $cat;
        return redirect()->route('admin.category.index')->with('datos','Registro editado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$cat = Category::find($id);
        $cat = Category::findOrFail($id);
        $cat->delete();
        return redirect()->route('admin.category.index')->with('datos','Registro eliminado correctamente');
    }
}
