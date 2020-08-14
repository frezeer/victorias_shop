<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //$categorias = Category::all();
            //$product= Product::orderBy('created_at','desc')->get();
            $categorias = Category::orderBy('nombre','asc')->paginate(5);
            return view('admin.category.index',compact('categorias'));

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
        return view('admin.category.create');
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
          return view('admin.category.show',compact('cat','editar'));
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
          $editar = 'Si';
          return view('admin.category.edit',compact('cat','editar'));
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
        $cat = Category::find($id);
        $cat->delete();
    }
}
