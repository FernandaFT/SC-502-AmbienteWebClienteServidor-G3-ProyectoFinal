$(function () {

    $("#formRegistro").validate({
        rules: {
            Identificacion: {
                required: true
            },
            Nombre: {
                required: true
            },
            Correo: {
                required: true,
                email: true
            },
            Contrasenna: {
                required: true,
                maxlength: 15
            }
        },
        messages: {
            Identificacion: {
                required: "Campo obligatorio"
            },
            Nombre: {
                required: "Campo obligatorio"
            },
            Correo: {
                required: "Campo obligatorio",
                email: "Formato incorrecto"
            },
            Contrasenna: {
                required: "Campo obligatorio",
                maxlength: "Máximo 15 caracteres"
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