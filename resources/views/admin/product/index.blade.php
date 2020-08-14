
@extends('plantillas.admin')
@section('titulo','Administracion de productos')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection
@section('contenido')
    {{ $productos }}
    <!-- /.row -->
        <div id="confirmareliminar" class="row">
         <span id="urlbase" style="display:none;" >{{ route('admin.product.index') }}</span>
          @include('custom.modal_eliminar')
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Productos </h3>
                <div class="card-tools">
                 
                <form >                   
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="nombre" class="form-control float-right"
                     placeholder="Buscar...." value="{{ request()->get('nombre') }}" >
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  </form>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
              <a class="m2 float-right btn btn-primary" href="{{ route('admin.product.create') }}">Nuevo producto</a>
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre producto</th>
                      <th>Slug</th>
                      
                      <th>cantidad</th>
                      <th>precio_actual</th>
                      <th>Descripcion</th>
                      <th colspan="3"></th>
                    </tr>
                  </thead>
                  <tbody>

                      @foreach ($productos as $producto)
                    <tr>
                      <td>{{ $producto->id }}</td>
                      <td>{{ $producto->nombre }}</td>
                      <td>{{ $producto->slug }}</td>
                      <td>{{ $producto->cantidad }}</td>
                      <td>
                          <span class="tag tag-success">{{ $producto->precio_actual }}</span>
                        </td>
                      <td>{{ $producto->descripcion_corta }}</td>                        
                      <td>
                          <a class="btn btn-default" 
                              href="{{ route('admin.product.show',$producto->slug) }}">
                              <i class="far fa-eye"></i>
                        </a>
                        </td>
                        <td>
                          <a class="btn btn-info" 
                          href="{{ route('admin.product.edit',$producto->slug) }}">
                          <i class="fas fa-edit"></i>
                        </a>
                        </td>
                        <td>
                          <a class="btn btn-danger" 
                            href="{{ route('admin.product.index') }}" 
                            v-on:click.prevent="deseas_eliminar({{$producto->id}})" >
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>                    
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $productos->appends($_GET)->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
@endsection