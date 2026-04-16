$(function () {

    $("#FormCambiarContrasenna").validate({
        rules: {
            NuevaContrasenna: {
                required: true,
                minlength: 6
            },
            ConfirmarContrasenna: {
                required: true,
                equalTo: "#NuevaContrasenna"
            }
        },
        messages: {
            NuevaContrasenna: {
                required: "Campo obligatorio",
                minlength: "Mínimo 6 caracteres"
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