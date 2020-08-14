<!-- Button trigger modal -->
<!----button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button----->

<!-- Modal -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEliminar">¿Deseas eliminar este registro?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @{{ urlaeliminar }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <form :action="urlaeliminar" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-primary">Si</button>
      </form>
      </div>
    </div>
  </div>
</div>