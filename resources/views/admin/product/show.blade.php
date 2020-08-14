     
     @extends('plantillas.admin')

     @section('titulo','Mostrar Categoria')

     @section('breadcrumb')
      <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Categorias</a></li>
      <li class="breadcrumb-item active">@yield('titulo')</li>
     @endsection


     @section('contenido')

      <div id="apiproduct">

     <form >

           @csrf    
           @method('PUT')

      <!-- Default box -->
        <span style="display:none;" id="editar">{{ $editar }}</span>
        <span style="display:none;" id="nombretemp">{{ $productos->nombre }}</span>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Administración de Productos</h3>

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
                    readonly
                    @blur= "getCategory"
                    @focus="div_aparecer=false"
                    
                    class="form-control" type="text" name="nombre" id="nombre" placeholder="Escribe el nombre de una categoria" 
                    value="{{ $productos->nombre }}" />
                    
                    <label for="slug">Slug</label>
                    <input readonly v-model="generarSlug" class="form-control" type="text" name="slug" id="slug"
                    value="{{ $productos->slug }}" />

                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                      @{{ div_mensajeslug }}
                    </div>

                    <br v-if="div_aparecer">

                    <label for="descripcion">Descripcion</label>
                    <textarea readonly class="form-control" name="descripcion" id="descripcion" cols="30" row="5">{{ $productos->descripcion }}</textarea>
                </div>
            
            <br />
            <br />
             <span>Valor del Nombre: <strong> @{{ nombre }}</strong></span> 
            <br />
            <br />
            <span>Generando cadena de Producto:<strong> @{{ generarSlug }}</strong></span>
            <br />
            <br />
            <span>Link Final :<strong> @{{ slug }} </strong></span>
               

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a class="btn btn-danger" href="{{ route('cancelar','admin.product.index') }}">Cancelar</a>

                
          <a class="btn btn-outline-success float-right" 
          href="{{ route('admin.product.edit',$productos->slug) }}" >Editar</a>
        
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </form>      
</div>      
@endsection