     
     @extends('plantillas.admin')

     @section('titulo','Crear Categoria')

     @section('contenido')

      <div id="apicategory">

       <form action="{{ route('admin.category.store') }}" method="POST">
           @csrf    
      <!-- Default box -->
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
                    class="form-control" type="text" name="nombre" id="nombre" placeholder="Escribe el nombre de una categoria">
                    <label for="slug">Slug</label>
                    <input readonly v-model="generarSlug" class="form-control" type="text" name="slug" id="slug">
                    
                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                      @{{ div_mensajeslug }}
                    </div>

                    <br v-if="div_aparecer">

                    <label for="descripcion">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" row="5"></textarea>
                </div>
            
            <br />
            <br />
            @{{ nombre }}
            <br />
            <br />
            @{{ generarSlug }}
            <br />
            <br />
            @{{ slug }}
               

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
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