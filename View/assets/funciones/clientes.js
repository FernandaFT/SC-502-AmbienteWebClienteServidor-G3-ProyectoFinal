
$(document).ready(function(){

    $("#formRegistroClientes").validate({

        rules:{
            nombre:{
                required:true
            },
            descripcion:{
                required:true,
                minlength:5
            }
        },

        messages:{
            nombre:{
                required:"Ingrese el nombre del cliente"
            },
            descripcion:{
                required:"Ingrese la descripción del cliente",
                minlength:"La descripción debe tener al menos 5 caracteres"
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

