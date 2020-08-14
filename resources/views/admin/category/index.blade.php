
@extends('plantillas.admin')
@section('titulo','Administracion de Categorias')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection
@section('contenido')

    <!-- /.row -->
        <div id="confirmareliminar" class="row">
         <span id="urlbase" style="display:none;" >{{ route('admin.category.index') }}</span>
          @include('custom.modal_eliminar')
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Categorias</h3>
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
              <a class="m2 float-right btn btn-primary" href="{{ route('admin.category.create') }}">Nueva Categoria</a>
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre Categoria</th>
                      <th>Slug</th>
                      
                      <th>Fecha de Creacion</th>
                      <th>Fecha de Actualización</th>
                      <th>Descripcion</th>
                      <th colspan="3"></th>
                    </tr>
                  </thead>
                  <tbody>

                      @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                      <td>{{ $categoria->nombre }}</td>
                      <td>{{ $categoria->slug }}</td>
                      <td>{{ $categoria->created_at }}</td>
                      <td>
                          <span class="tag tag-success">{{ $categoria->updated_at }}</span>
                        </td>
                      <td>{{ $categoria->descripcion }}</td>                        
                      <td>
                          <a class="btn btn-default" 
                              href="{{ route('admin.category.show',$categoria->slug) }}">
                              <i class="far fa-eye"></i>
                        </a>
                        </td>
                        <td>
                          <a class="btn btn-info" 
                          href="{{ route('admin.category.edit',$categoria->slug) }}">
                          <i class="fas fa-edit"></i>
                        </a>
                        </td>
                        <td>
                          <a class="btn btn-danger" 
                            href="{{ route('admin.category.index') }}" 
                            v-on:click.prevent="deseas_eliminar({{$categoria->id}})" >
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>                    
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $categorias->appends($_GET)->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
@endsection