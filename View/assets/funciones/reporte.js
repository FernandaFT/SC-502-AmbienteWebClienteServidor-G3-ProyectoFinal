$(document).ready(function () {

    $.validator.addMethod("fechaFinValida", function (value, element) {
        var ini = $("#fechaInicio").val();
        if (!ini || !value) {
            return true;
        }
        return new Date(ini + "T00:00:00") <= new Date(value + "T00:00:00");
    }, "La fecha de inicio no puede ser posterior a la fecha fin.");

    $("#FormReporteHoras").validate({
        rules: {
            fechaInicio: {
                required: true
            },
            fechaFin: {
                required: true,
                fechaFinValida: true
            }
        },
        messages: {
            fechaInicio: {
                required: "Seleccione la fecha de inicio"
            },
            fechaFin: {
                required: "Seleccione la fecha fin"
            }
        },
        errorElement: "span",
        errorClass: "text-danger",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });

    $("#fechaInicio, #fechaFin").on("change", function () {
        if ($("#FormReporteHoras").data("validator")) {
            $("#fechaFin").valid();
        }
    });

});
