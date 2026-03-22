$(document).ready(function(){

    $("#formRegistroHoras").validate({

        rules:{
            id_cliente:{
                required:true
            },
            id_categoria:{
                required:true
            },
            cantidad_horas:{
                required:true,
                digits:true,
                min:1
            },
            fecha:{
                required:true,
                date:true
            }
        },

        messages:{
            id_cliente:{
                required:"Debe seleccionar un cliente"
            },
            id_categoria:{
                required:"Debe seleccionar una categoría"
            },
            cantidad_horas:{
                required:"Ingrese la cantidad de horas",
                digits:"Ingrese solo números enteros",
                min:"Debe registrar al menos 1 hora"
            },
            fecha:{
                required:"Debe ingresar la fecha",
                date:"Ingrese una fecha válida"
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
