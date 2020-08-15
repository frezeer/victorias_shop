const apiproduct = new Vue({
    el: '#apiproduct',
            data:{
                nombre: '',
                slug: '',
                div_mensajeslug: 'Slug Existente',
                div_clase_slug:  'badge badge-danger',
                div_aparecer: false,
                deshabilitar_boton:1,
                //precios
                precio_anterior:0,
                precio_actual:0,
                descuento:0,
                porcentaje_descuento:0,
                descuento_mensaje:'0'
            },
            computed: {
                generarSlug : function()
                {
                     var char = {
                         "á":"a","é":"e","í":"i","ó":"o","ú":"u",
                         "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
                         "ñ":"n","Ñ":"N"," ":"-","_":"-"
                     } 
                    var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;
                    this.slug = this.nombre.trim().replace(expr, function(e){
                        return char[e]; 
                    }).toLowerCase();
                    
                    return this.slug;
                     
                },
                       generarDescuentos : function() {
                if(this.porcentaje_descuento>100){
                    //alert('no puedes poner un valor mayor a 100');
                    Swal.fire({
                      title: 'Error!',
                      text: '¡no puedes poner un valor mayor a 100!',
                      icon: 'error',
                     confirmButtonText: 'Continuar'
                     })
                     this.descuento_mensaje = "Este Producto tiene el "+ this.porcentaje_descuento +" por ende es gratis";
                     this.porcentaje_descuento = '0';
                }    
                if(this.porcentaje_descuento<0){
                    //alert('no puedes poner un valor menor a 0');
                     Swal.fire({
                      title: 'Error!',
                      text: '¡no puedes poner un valor menor a 0!',
                      icon: 'error',
                     confirmButtonText: 'Continuar'
                     })
                     this.descuento_mensaje = "Este Producto tiene el "+ this.porcentaje_descuento +" por ende es gratis";
                     this.porcentaje_descuento = '0';
                }    
                 if(this.porcentaje_descuento>0)
                 {
                   this.descuento         =  (this.precio_anterior * this.porcentaje_descuento) / 100;
                   this.precio_actual     =  (this.precio_anterior - this.descuento);
                   if(this.porcentaje_descuento == 100)
                   {
                     this.descuento_mensaje = "Este Producto tiene el "+ this.porcentaje_descuento +" por ende es gratis";
                   }else{
                     this.descuento_mensaje = "Hay un descuento de MX"+ this.descuento;
                   }
                   return this.descuento_mensaje;   
                 }
                else{
                  this.descuento ='';
                  this.precio_actual = this.precio_anterior;
                  this.descuento_mensaje = '';
                  return this.descuento_mensaje;
                }
              } 
            },
            methods:
            {
                getProduct(){
                    if(this.slug){
                    let url = '/api/product/'+this.slug;
                    axios.get(url).then(response => {
                        this.div_mensajeslug = response.data;
                        console.log(this.div_mensajeslug);
                        if(this.div_mensajeslug === "Slug Disponible"){
                            this.div_clase_slug = 'badge badge-success';
                            this.deshabilitar_boton = 0;
                        } else{
                             this.div_clase_slug = 'badge badge-danger';
                            this.deshabilitar_boton = 1;    
                        }
                         this.div_aparecer = true;
                    });
                    }else{
                    this.div_mensajeslug ="Debes Escribir un Producto";
                    this.div_clase_slug = 'badge badge-danger';
                    this.deshabilitar_boton = 1;
                    this.div_aparecer = true;
                    } 
               }
            },
            mounted()
            {
                if(document.getElementById('editar'))
                {
                    this.nombre =  document.getElementById('nombretemp').innerHTML;
                    //console.log(this.nombre);
                    this.deshabilitar_boton=0;
                }
            }
        });
