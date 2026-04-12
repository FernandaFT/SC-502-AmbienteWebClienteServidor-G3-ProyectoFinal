$(document).ready(function () {

    $("#formPermiso").validate({

        ignore: [],

        rules: {
            fecha_inicio: {
                required: true,
                date: true
            },
            fecha_fin: {
                required: true,
                date: true
            },
            categoria: {
                required: true
            },
            descripcion: {
                required: true,
                maxlength: 500
            }
        },

        messages: {
            fecha_inicio: {
                required: "Seleccione la fecha de inicio",
                date: "Ingrese una fecha válida"
            },
            fecha_fin: {
                required: "Seleccione la fecha de fin",
                date: "Ingrese una fecha válida"
            },
            categoria: {
                required: "Seleccione una categoría"
            },
            descripcion: {
                required: "Ingrese la descripción",
                maxlength: "Máximo 500 caracteres"
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
        },

        submitHandler: function (form) {

            const fechaInicio = new Date($("#fecha_inicio").val());
            const fechaFin = new Date($("#fecha_fin").val());

            const dias = Math.ceil(
                (fechaFin - fechaInicio) / (1000 * 60 * 60 * 24)
            ) + 1;

            if (dias > 30) {
                alert("El permiso no puede exceder 30 días. Días solicitados: " + dias);
                return false;
            }

            form.submit();
        }

    });

    const descInput = document.getElementById('descripcion');
    const charCount = document.getElementById('charCount');

    if (descInput && charCount) {
        descInput.addEventListener('input', function () {
            charCount.textContent = this.value.length + '/500';
        });

        charCount.textContent = descInput.value.length + '/500';
    }

    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');

    if (fechaInicio && fechaFin) {
        fechaInicio.addEventListener('change', function () {
            fechaFin.min = this.value;

            if (fechaFin.value && fechaFin.value < this.value) {
                fechaFin.value = '';
            }
        });
    }

});