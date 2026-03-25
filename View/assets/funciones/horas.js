$(document).ready(function(){

    $("#formRegistroHoras").validate({

        rules:{
            id_cliente:{
                required:true
            },
            id_categoria_hora:{
                required:true
            },
            cantidad:{
                required:true,
                digits:true,
                min:1
            },
            descripcion:{
                required:true,
                maxlength:255
            },
            fecha:{
                required:true
            }
        },

        messages:{
            id_cliente:{
                required:"Debe seleccionar un cliente"
            },
            id_categoria_hora:{
                required:"Debe seleccionar una categoría"
            },
            cantidad:{
                required:"Ingrese la cantidad de horas",
                digits:"Ingrese solo números enteros",
                min:"Debe registrar al menos 1 hora"
            },
            descripcion:{
                required:"Ingrese la descripción"
            },
            fecha:{
                required:"Debe ingresar la fecha"
            }
        },

        errorElement:"span",
        errorClass:"text-danger",

        errorPlacement:function(error, element){
            error.insertAfter(element);
        },

        highlight:function(element){
            $(element).addClass("is-invalid");
        },

        unhighlight:function(element){
            $(element).removeClass("is-invalid");
        }

    });

});