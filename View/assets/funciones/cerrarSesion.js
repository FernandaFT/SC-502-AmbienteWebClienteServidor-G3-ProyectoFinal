function CerrarSesion() {

        $.ajax({
            url: "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerLogin.php",
            method: 'POST',
            dataType: 'json',
            data:{ btnCerrarSesion: true},
            success: function (response) {
                window.location.href = "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/vHome/inicio_sesion.php";
            }
        });
}