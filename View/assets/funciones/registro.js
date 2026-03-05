$(document).ready(function(){

    $("#formRegistro").validate({

        rules:{
            nombre:{
                required:true
            },
            correo:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:6
            },
            rol:{
                required:true
            }
        },

        messages:{
            nombre:{
                required:"Ingrese el nombre"
            },
            correo:{
                required:"Ingrese el correo electrónico",
                email:"Ingrese un correo electrónico válido"
            },
            password:{
                required:"Ingrese la contraseña",
                minlength:"La contraseña debe tener al menos 6 caracteres"
            },
            rol:{
                required:"Debe seleccionar un rol"
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