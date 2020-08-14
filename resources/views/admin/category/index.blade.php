
@extends('plantillas.admin')
@section('titulo','Listar Categoria')
@section('contenido')

    <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Categorias</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
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
                          href="{{ route('admin.category.destroy',$categoria->id) }}">
                          <i class="fas fa-trash"></i>
                        </a>
                        </td>                    
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $categorias->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
@endsection