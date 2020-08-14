     
     @extends('plantillas.admin')

     @section('titulo','Editar Categoria')

     @section('breadcrumb')
      <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categorias</a></li>
      <li class="breadcrumb-item active">@yield('titulo')</li>
     @endsection


     @section('contenido')

      <div id="apicategory">

     <form action="{{ route('admin.category.update', $cat->id) }}" method="POST">
           @csrf    
           @method('PUT')
      <!-- Default box -->
        <span style="display:none;" id="editar">{{ $editar }}</span>
        <span style="display:none;" id="nombretemp">{{ $cat->nombre }}</span>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Administración de Categorias</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
                <div class="form-group">                    
                    <label  for="nombre">Nombre</label>
                    <input v-model="nombre"
                    
                    @blur= "getCategory"
                    @focus="div_aparecer=false"
                    
                    class="form-control" type="text" name="nombre" id="nombre" placeholder="Escribe el nombre de una categoria" 
                    value="{{ $cat->nombre }}">
                    
                    <label for="slug">Slug</label>
                    <input readonly v-model="generarSlug" class="form-control" type="text" name="slug" id="slug"
                    value="{{ $cat->slug }}">

                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                      @{{ div_mensajeslug }}
                    </div>

                    <br v-if="div_aparecer">

                    <label for="descripcion">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" row="5">{{ $cat->descripcion }}</textarea>
                </div>
            
            <br />
            <br />
             <span>Valor del Nombre: <strong> @{{ nombre }}</strong></span> 
            <br />
            <br />
            <span>Generando cadena de Categoria:<strong> @{{ generarSlug }}</strong></span>
            <br />
            <br />
            <span>Link Final :<strong> @{{ slug }} </strong></span>
               

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a class="btn btn-danger" href="{{ route('cancelar','admin.category.index') }}">Cancelar</a>
                  <input 
                    :disabled = "deshabilitar_boton==1"
                    type="submit" class="btn btn-primary float-right" value="Guardar" >
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </form>      
</div>      
@endsection