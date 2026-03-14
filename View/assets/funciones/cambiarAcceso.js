$(function () {

    $("#FormCambiarContrasenna").validate({
        rules: {
            NuevaContrasenna: {
                required: true,
                minlength: 8
            },
            ConfirmarContrasenna: {
                required: true,
                equalTo: "#NuevaContrasenna"
            }
        },
        messages: {
            NuevaContrasenna: {
                required: "Campo obligatorio",
                minlength: "Mínimo 8 caracteres"
            },
            ConfirmarContrasenna: {
                required: "Campo obligatorio",
                equalTo: "Las contraseñas no coinciden"
            }
        },
        errorElement: "span",
        errorClass: "text-danger",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });

});