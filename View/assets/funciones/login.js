$(document).ready(function(){

    $("#FormInicioSesion").validate({

        rules:{
            correo:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:6
            }
        },

        messages:{
            correo:{
                required:"Ingrese el correo electrónico",
                email:"Ingrese un correo electrónico válido"
            },
            password:{
                required:"Ingrese la contraseña",
                minlength:"La contraseña debe tener al menos 6 caracteres"
            }           
        },

        errorElement:"span",
        errorClass:"text-danger",

        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },

        highlight: function(element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function(element) {
            $(element).removeClass("is-invalid");
        }

    });

});