$(document).ready(function(){

    $("#formVacaciones").validate({

        rules:{
            fecha_inicio:{ required:true },
            fecha_fin:{ required:true },
            descripcion:{
                required:true,
                maxlength:500
            }
        },

        messages:{
            fecha_inicio:{ required:"Seleccione la fecha de inicio" },
            fecha_fin:{ required:"Seleccione la fecha de fin" },
            descripcion:{
                required:"Ingrese la descripción",
                maxlength:"Máximo 500 caracteres"
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
        },

        submitHandler:function(form){

            $("#mensajeVacaciones").html(""); // limpiar siempre

            let inicio = new Date($("#fecha_inicio").val());
            let fin = new Date($("#fecha_fin").val());

            let dias = Math.floor((fin - inicio) / (1000 * 60 * 60 * 24)) + 1;
            let disponibles = parseInt($("#diasDisponibles").val());

            if(fin < inicio){
                $("#mensajeVacaciones").html(
                    "<div class='alert alert-danger'>La fecha fin no puede ser menor que la fecha inicio</div>"
                );
                return; // ← IMPORTANTE
            }

            if(dias > disponibles){
                $("#mensajeVacaciones").html(
                    "<div class='alert alert-danger'>No tiene suficientes días disponibles. Tiene: " + disponibles + "</div>"
                );
                return; // ← IMPORTANTE
            }

            form.submit(); // solo si todo OK
        }

    });


    function calcularDias(){

        let fechaInicio = $("#fecha_inicio").val();
        let fechaFin = $("#fecha_fin").val();

        if(fechaInicio === "" || fechaFin === ""){
        $("#dias").val("");
        return;
        }

        let inicio = new Date(fechaInicio);
        let fin = new Date(fechaFin);

        let diferencia = fin.getTime() - inicio.getTime();

        let dias = Math.floor(diferencia / (1000 * 60 * 60 * 24)) + 1;

        if(dias < 0){
        $("#dias").val(0);
        return;
        }

        $("#dias").val(dias);

        }

        // cuando cambia fecha inicio
        $("#fecha_inicio").on("change", function(){
        calcularDias();
        });

        // cuando cambia fecha fin
        $("#fecha_fin").on("change", function(){
        calcularDias();
    });


});