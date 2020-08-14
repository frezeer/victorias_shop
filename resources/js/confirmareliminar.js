const confirmareliminar = new Vue({
    el: '#confirmareliminar',
            data:{
                urlaeliminar: ''
            },
            methods:
            {
                deseas_eliminar(id){
                    //alert(id);
                    this.urlaeliminar = document.getElementById('urlbase').innerHTML+'/'+id;
                    //alert(this.urlaeliminar)
                    $('#modalEliminar').modal('show');
                }
            }
 });
