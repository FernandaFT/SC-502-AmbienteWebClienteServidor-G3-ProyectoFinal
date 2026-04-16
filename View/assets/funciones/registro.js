$(document).ready(function(){

    $("#formRegistro").validate({

        rules:{
            identificacion:{
                required:true
            },
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
            identificacion:{
                required:"Ingrese una identificación"
            },
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

function ConsultarNombre() {

    document.getElementById("nombre").value = "";
    let identificacion = document.getElementById("identificacion").value;

    if (identificacion.length >= 9) {
        $.ajax({
            url: 'https://apis.gometa.org/cedulas/' + identificacion,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if(response.resultcount > 0)
                {
                    document.getElementById("nombre").value = response.nombre;
                }                
            }
        });
    }
}