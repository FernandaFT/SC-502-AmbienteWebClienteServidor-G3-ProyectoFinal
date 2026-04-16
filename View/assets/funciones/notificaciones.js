// Cargar notificaciones al abrir la página
$(document).ready(function () {
    cargarNotificaciones();
    // Recargar cada 30 segundos
    setInterval(cargarNotificaciones, 30000);
    // Evento para marcar todas como leídas - usa botón existente en layoutGeneral.php
    $(document).on('click', '#marcarTodasLeidasBtn', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../../Controller/ControllerNotificaciones.php?action=marcar_todas',
            type: 'GET',
            dataType: 'json',
            timeout: 5000,
            success: function (response) {
                if (response.success) {
                    // Ocultar badge completamente
                    $('#notificacionesCounter').css('display', 'none').text('');
                    
                    // Limpiar contenedor y mostrar mensaje
                    $('#notificacionesContainer').html(`
                        <div class="text-center p-3">
                            <i class="mdi mdi-bell-off-outline text-muted" style="font-size: 24px;"></i>
                            <p class="text-muted mb-0">No tienes notificaciones nuevas</p>
                        </div>`
                    );
                    
                    // Cerrar dropdown
                    $('#notificationDropdown').dropdown('hide');
                }
            }
        });
    });
});

function cargarNotificaciones() {
    $.ajax({
        url: '../../Controller/ControllerConsultarNotificaciones.php',
        type: 'GET',
        dataType: 'json',
        timeout: 5000,
        success: function (response) {
            let html = '';
            let contador = (response && response.length) ? response.length : 0;
            let container = $('#notificacionesContainer');
            let badge = $('#notificacionesCounter');

            // Limpiar el contenedor ANTES de llenar
            container.empty();

            if (contador > 0) {
                // Actualizar el contador rojo (badge) - mostrar con display flex
                badge.text(contador).css('display', 'flex');

                // Recorrer los resultados SIN crear botón duplicado
                response.forEach(function (notif) {
                    html += `
                        <a class="dropdown-item preview-item marcar-notif-leida" href="#" data-id="${notif.id_notificacion}" data-count="${contador}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="mdi mdi-information-outline"></i>
                                </div>
                            </div>
                            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1" style="font-size: 13px; white-space: normal;">
                                    ${notif.descripcion}
                                </h6>
                                <p class="text-gray ellipsis mb-0" style="font-size: 10px;"> 
                                    <i class="mdi mdi-account"></i> ${notif.nombre_origen || 'Sistema'} | 
                                    <i class="mdi mdi-clock-outline"></i> ${notif.fecha_creacion}
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>`;
                });
            } else {
                // Si no hay notificaciones
                badge.css('display', 'none');
                html = `
                    <div class="text-center p-3">
                        <i class="mdi mdi-bell-off-outline text-muted" style="font-size: 24px;"></i>
                        <p class="text-muted mb-0">No tienes notificaciones nuevas</p>
                    </div>`;
            }

            // Inyectar el HTML en el contenedor LIMPIO
            container.html(html);

            // Registrar evento click en cada notificación
            $('.marcar-notif-leida').on('click', function(e) {
                e.preventDefault();
                let idNotif = $(this).data('id');
                let contador = $(this).data('count');
                
                // Marcar como leída
                $.ajax({
                    url: '../../Controller/ControllerNotificaciones.php?action=marcar_leida&id=' + idNotif,
                    type: 'GET',
                    dataType: 'json',
                    timeout: 5000,
                    success: function (response) {
                        if (response.success) {
                            // Actualizar contador
                            let nuevoContador = response.contador;
                            if (nuevoContador > 0) {
                                $('#notificacionesCounter').text(nuevoContador).css('display', 'flex');
                            } else {
                                $('#notificacionesCounter').css('display', 'none');
                            }
                            // Determinar rol y redirigir
                            let rol = userRol || 2;
                            let urlDestino = rol == 1 
                                ? 'inicio.php?vista=pantallaAccionesAdmin'
                                : 'inicio.php?vista=mi_solicitudes';
                            
                            // Redirigir
                            setTimeout(function() { window.location.href = urlDestino;}, 300);
                        }
                    }
                });
            });
        },
        error: function (xhr, status, error) {
            console.warn("Notificaciones - Error:", error);
            $('#notificacionesContainer').html(
                '<p class="text-center p-2 text-muted"><small>Error al cargar</small></p>'
            );
        }
    });
}